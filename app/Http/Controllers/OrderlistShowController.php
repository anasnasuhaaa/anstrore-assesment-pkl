<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Support\Facades\DB;

class OrderlistShowController extends Controller
{
    //
    public function show(string $id)
    {

        try {
            $order_details =  $this->getOrderDetailsQuery()->where('order_details.id', $id)->first();
            return view('pages.orderlist.show', compact('order_details'));
        } catch (Throwable $err) {
            dd($err);
            return redirect()->back()->with('error', 'error cuy');
        }
    }
    public function orderArrived(string $id)
    {
        try {

            DB::table('order_details')
                ->where('id', $id)
                ->update(['order_status' => 'diterima']);

            return redirect(route('user.orderlist.show', $id));
        } catch (Throwable $err) {
            dd($err);
        }
    }

    private function getOrderDetailsQuery()
    {
        return DB::table('order_details')->orderBy('created_at', 'desc')
            ->join('produk', 'produk.id', '=', 'order_details.product_id')
            ->join('users', 'users.id', '=', 'order_details.user_id')
            ->join('payments', 'payments.id', '=', 'order_details.payment_id')
            ->join('categories', 'categories.id', '=', 'produk.category_id')
            ->select(
                'order_details.*',
                'order_details.price as order_details_price',
                'order_details.created_at as created_at',
                'categories.name as product_category',
                'produk.id as product_id',
                'produk.name as product_name',
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
