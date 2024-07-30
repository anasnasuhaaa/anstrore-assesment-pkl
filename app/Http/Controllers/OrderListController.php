<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\OrderDetails;
use App\Exports\OrderDetailsExport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class OrderListController extends Controller
{
    //
    public function index()
    {
        $order_details = OrderDetails::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.orderlist.index', compact('order_details'));
    }
    public function show(string $id)
    {
        $order_details = OrderDetails::find($id);
        return view('admin.orderlist.show', compact('order_details'));
    }
    public function approve(string $id)
    {
        $order_details = OrderDetails::find($id);
        $order_details->order_status = 'dikirim';
        $order_details->save();
        return redirect(route('admin.orderlist.index'));
    }
    public function userIndex()
    {
        $user_id = Auth::user()->id;
        $order_details = OrderDetails::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(5);

        return view('pages.orderlist.index', compact('order_details'));
    }
    public function export()
    {
        return Excel::download(new OrderDetailsExport, 'orderlist.xlsx');
    }
}
