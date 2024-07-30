<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast;
use Throwable;

class OrderArrivedController extends Controller
{
    //
    public function store(Request $request)
    {
        try {

            $order_detail = OrderDetails::find($request->id);
            if ($order_detail->order_status == 'dikirim') {
                $order_detail->order_status = 'diterima';
                $order_detail->save();
                return redirect()->back();
            }
        } catch (Throwable $err) {
            dd($err);
        }
    }
}
