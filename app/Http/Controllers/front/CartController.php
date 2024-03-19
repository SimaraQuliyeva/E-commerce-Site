<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
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
        return view('front.pages.cart',compact('cartItem','totalPrice'));
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

        return back()->withSuccess('Product added');
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
}
