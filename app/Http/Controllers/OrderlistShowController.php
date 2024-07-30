<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Throwable;

class OrderlistShowController extends Controller
{
    //
    public function show(string $id)
    {
        $order_details = OrderDetails::find($id);

        return view('pages.orderlist.show', compact('order_details'));
    }
    public function orderArrived(string $id)
    {
        dd($id);
        try {

            $order_details = OrderDetails::find($id);
            $order_details->order_status = 'diterima';
            $order_details->save();
            return redirect(route('user.orderlist.show', $id));
        } catch (Throwable $err) {
            dd($err);
        }
    }
}
