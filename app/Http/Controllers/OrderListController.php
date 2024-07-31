<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Exports\OrderDetailsExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class OrderListController extends Controller
{
    //
    public function index()
    {
        $order_details = $this->getOrderDetailsQuery()

            ->paginate(10);

        foreach ($order_details as $item) {
            $item->created_at = Carbon::parse($item->created_at);
        }

        return view('admin.orderlist.index', compact('order_details'));
    }
    public function show(string $id)
    {
        $order_details = $this->getOrderDetailsQuery()
            ->where('order_details.id', $id)

            ->get();

        return view('admin.orderlist.show', compact('order_details'));
    }
    public function approve(string $id)
    {
        DB::table('order_details')
            ->where('id', $id)
            ->update(['order_status' => 'dikirim']);
        return redirect(route('admin.orderlist.index'));
    }
    public function userIndex()
    {
        $user_id = Auth::user()->id;
        // $order_details = OrderDetails::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(5);
        $order_details = $this->getOrderDetailsQuery()->where('user_id', $user_id)
            ->paginate(5);

        // foreach ($order_details as $item) {
        //     $order_details->created_at = Carbon::parse($order_details->created_at);
        // }

        foreach ($order_details as $item) {
            $item->created_at = Carbon::parse($item->created_at);
        }
        return view('pages.orderlist.index', compact('order_details'));
    }
    public function export()
    {
        return Excel::download(new OrderDetailsExport, 'orderlist.xlsx');
    }

    private function getOrderDetailsQuery()
    {
        return DB::table('order_details')->orderBy('order_details.created_at', 'asc')
            ->join('produk', 'produk.id', '=', 'order_details.product_id')
            ->join('users', 'users.id', '=', 'order_details.user_id')
            ->join('payments', 'payments.id', '=', 'order_details.payment_id')
            ->join('categories', 'categories.id', '=', 'produk.category_id')
            ->select(
                'order_details.*',
                'order_details.price as order_details_price',
                'order_details.created_at as created_at',
                'produk.name as product_name',
                'categories.name as product_category',
                'produk.description as product_description',
                'produk.image as product_image',
                'produk.price as product_price',
                'produk.stock as product_stock',
                'produk.created_at as product_created_at',
                'users.name as user_name',
                'users.email as user_email',
                'payments.name as payment_name',
                'payments.image as payment_image'
            );
    }
}
