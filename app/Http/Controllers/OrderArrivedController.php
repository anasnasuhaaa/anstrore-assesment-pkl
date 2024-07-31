<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderArrivedController extends Controller
{
    //
    public function store(Request $request)
    {
        try {

            $order_detail = DB::table('order_details')->where('id', $request->id)->first();
            if ($order_detail && $order_detail->order_status == 'dikirim') {
                DB::table('order_details')->where('id', $request->id)
                    ->update(['order_status' => 'diterima']);
                return redirect()->back();
            }

            return redirect()->back()->withErrors('Order tidak ditemukan atau status tidak valid.');
        } catch (Throwable $err) {
            dd($err);
        }
    }
}
