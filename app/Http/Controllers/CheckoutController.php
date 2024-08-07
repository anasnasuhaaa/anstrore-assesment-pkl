<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    //
    public function index(string $id)

    {
        $product = DB::table('produk')->first();
        $payment = DB::table('payments')->get();
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
        // $order_detail = new OrderDetails();
        // $order_detail->product_id = $id;
        // $order_detail->user_id = auth()->user()->id;
        // $order_detail->phone = $request->phone;
        // $order_detail->address = $request->address;
        // $order_detail->payment_id = $request->payment;
        // $order_detail->qty = $request->qty;

        $data = [
            'product_id' => $id,
            'user_id' => auth()->user()->id,
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'payment_id' => $request->input('payment'),
            'qty' => $request->input('qty'),
            'price' => $request->input('total')
        ];

        // $order_detail->price = $request->total;
        // $product = Product::find($id);
        // $product->stock -= $request->qty;
        DB::table('order_details')->insert($data);
        DB::table('produk')->where('id', $id)->decrement('stock', $request->input('qty'));
        // $order_detail->save();

        return redirect(route('user.orderlist.index'));
    }
}
