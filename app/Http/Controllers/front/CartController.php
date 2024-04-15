<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use function Symfony\Component\String\b;

class CartController extends Controller
{
    public function index()
    {
        $cartItem=session('cart',[]);
        $totalPrice=0;
        foreach ($cartItem as $cart){
            $totalPrice+=$cart['price'] * $cart['quantity'];
        }
        if(session()->get('coupon_code')){
            $coupon=Coupon::where('name', session()->get('coupon_code'))->where('status', '1')->first();
            $couponPrice=$coupon->price ?? 0;
            $couponCode=$coupon->name ?? '';
            $newTotalPrice= $totalPrice -$couponPrice;
        } else{
            $newTotalPrice= $totalPrice;
        }

        session()->put('total_price', $newTotalPrice);

        return view('front.pages.cart',compact('cartItem'));
    }

    public function cartForm(){
        $cartItem=session('cart',[]);
        $totalPrice=0;
        foreach ($cartItem as $cart){
            $totalPrice+=$cart['price'] * $cart['quantity'];
        }
        if(session()->get('coupon_code')){
            $coupon=Coupon::where('name', session()->get('coupon_code'))->where('status', '1')->first();
            $couponPrice=$coupon->price ?? 0;
            $couponCode=$coupon->name ?? '';
            $newTotalPrice= $totalPrice -$couponPrice;
        } else{
            $newTotalPrice= $totalPrice;
        }

        session()->put('total_price', $newTotalPrice);

        return view('front.pages.checkout',compact('cartItem'));
    }

    public function add(Request $request){
//        dd($request)->all();
        $productId=$request->productId;
        $quantity=$request->quantity ?? 1;
        $size=$request->size;
        $product=Product::find($productId);
       if (!$product){
           return back()->withError('Product not found');
       }

       $cartItem=session('cart',[]);
       if (array_key_exists($productId,$cartItem)){
           $cartItem[$productId]['quantity']+=$quantity;
       }else{
           $cartItem[$productId]=[
               'image'=>$product->image,
               'name'=>$product->name,
               'price'=>$product->price,
               'quantity'=>$quantity,
               'size'=>$size,
           ];
       }
       session(['cart'=>$cartItem]);
       if ($request->ajax()){
           return response()->json(['Cart Updated']);
       }

        return back()->withSuccess('Product added');
    }

    public function newQty(Request $request){
        $productId = $request->productId;
        $quantity = $request->quantity ?? 1;
        $itemTotal = 0;
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found']);
        }

        $cartItem = session('cart', []);

        if (array_key_exists($productId, $cartItem)) {
            if ($quantity > 0) {
                $cartItem[$productId]['quantity'] = $quantity;
            } else {
                unset($cartItem[$productId]);
            }
            $itemTotal = $product->price * ($cartItem[$productId]['quantity'] ?? 0);
        }

        session(['cart' => $cartItem]);

        if ($request->ajax()) {
            return response()->json(['itemTotal' => $itemTotal, 'message' => 'Cart Updated']);
        }
    }


    public function delete(Request $request){

        $productId = $request->productId;
        $cartItem = session('cart', []);
        if (array_key_exists($productId,$cartItem)){
           unset($cartItem[$productId]);
        }
        session(['cart' => $cartItem]);
        return back()->withSuccess('Product removed from cart');
    }

    public function coupon (Request $request)
    {
        $cartItem=session('cart',[]);
        $totalPrice=0;
        foreach ($cartItem as $cart){
            $totalPrice+=$cart['price'] * $cart['quantity'];
        }

    $coupon = Coupon::where('name', $request->name)->where('status', '1')->first();

        if(empty($coupon)){
            return back()->withError('Coupon not found');
        }

        if ($request->has('remove_coupon')) {
            session()->forget('coupon_code');
            return back()->withSuccess('Coupon removed');
        }

        $couponPrice=$coupon->price ?? 0;
        $couponCode=$coupon->name ?? '';

        $newTotalPrice= $totalPrice -$couponPrice;

        session()->put('total_price', $newTotalPrice);
        session()->put('coupon_code', $couponCode);

        return back()->withSuccess('Coupon added');

    }

    public function cartSave(Request $request){
            return $request->all();
    }

}
