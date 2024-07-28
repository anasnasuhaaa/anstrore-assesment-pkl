<?php

namespace App\Http\Controllers;

use App\Exports\OrderDetailsExport;
use App\Models\OrderDetails;
use Maatwebsite\Excel\Facades\Excel;

class OrderListController extends Controller
{
    //
    public function index()
    {
        $order_details = OrderDetails::all();

        return view('admin.orderlist.index', compact('order_details'));
    }
    public function show()
    {
        return view('admin.orderlist.show');
    }
    public function userIndex()
    {
        $order_details = OrderDetails::all();
        return view('pages.orderlist', compact('order_details'));
    }
    public function export()
    {
        return Excel::download(new OrderDetailsExport, 'orderlist.xlsx');
    }
}
