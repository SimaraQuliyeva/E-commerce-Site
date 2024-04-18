<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders=Invoice::paginate('10');
        return view('back.pages.orders.index',compact('orders'));
    }

    public function edit($id)
    {
//        $orders=session('order',[]);

        $invoice = Invoice::where('id', $id)->with('orders')->firstOrFail();

        $coupon = Coupon::where('name', session()->get('coupon_code'))->where('status', '1')->first();
        $couponPrice = $coupon->price ?? 0;

        $totalPrice = 0;
        $totalQuantity = 0;

        foreach ($invoice->orders as $order) {
            $totalPrice += $order->price * $order->quantity;
            $totalQuantity += $order->quantity;
        }
        $totalPrice -= $couponPrice;

        session()->put('total_price', $totalPrice);
        return view('back.pages.orders.edit', compact('invoice', 'couponPrice', 'totalPrice', 'totalQuantity'));

    }

    public function destroy(Request $request)
    {
        $order = Invoice::where('id', $request->id)->firstOrFail();
        Order::where('order_no', $order->order_no)->delete();
        $order->delete();
        return response(['error'=>false, 'message'=>'Order deleted successfully']);

    }

    public function status(Request $request)
    {
        $update = $request->statu;
        $status = $update == 'true' ? true : false;

        Invoice::where('id', $request->id)->update(['status' => $status]);

        return response(['error' => false, 'status' => $status]);
    }

    public function updateTotalPrice($invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $totalPrice = $invoice->orders()->sum('price');

        // Kupon indirimi varsa uygula
        $couponPrice = $invoice->coupon->price ?? 0;
        $totalPrice -= $couponPrice;

        // Toplam fiyatı güncelle
        $invoice->update(['total_price' => $totalPrice]);

        return redirect()->back()->withSuccess('Total price updated successfully');
    }


}
