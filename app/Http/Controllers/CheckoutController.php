<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function index(string $id)

    {
        $product = Product::findOrFail($id);
        $payment = Payment::all();
        $qty = session('qty');
        $price = $product->price;
        $total = $qty * $price;

        return view('pages.checkout', compact('product', 'payment', 'id', 'price', 'qty', 'total'));
    }
    public function store(Request $request, string $id)
    {
        $request->validate([
            'phone' => 'required',
            'payment' => 'required',
            'address' => 'required',
            'qty' => 'required',
            'total' => 'required'
        ]);
        $order_detail = new OrderDetails();
        $order_detail->product_id = $id;
        $order_detail->user_id = auth()->user()->id;
        $order_detail->phone = $request->phone;
        $order_detail->address = $request->address;
        $order_detail->payment_id = $request->payment;
        $order_detail->qty = $request->qty;

        $order_detail->price = $request->total;
        $product = Product::find($id);
        $product->stock -= $request->qty;
        $order_detail->save();

        return redirect(route('user.orderlist.index'));
    }
}
