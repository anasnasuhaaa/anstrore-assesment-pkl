<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class UserProductController extends Controller
{
    //
    public function show(string $id)
    {

        $product = DB::table('produk')->where('produk.id', $id)
            ->join('categories', 'categories.id', '=', 'produk.category_id')
            ->select(
                'produk.*',
                'produk.name as product_name',
                'produk.image as product_image',
                'produk.price as product_price',
                'categories.name as category_name'
            )
            ->first();

        $review = DB::table('reviews')->where('product_id', $id)->orderBy('created_at', 'desc')
            ->join('users', 'users.id', '=', 'reviews.user_id')
            ->select(
                'reviews.*',
                'users.name as user_name'
            )
            ->get();

        foreach ($review as $item) {
            $item->created_at = Carbon::parse($item->created_at);
        }
        return view('pages.detail', compact('product', 'review'));
    }
    public function checkout(Request $request, string $id)
    {
        $qty = $request->qty;

        return redirect(route('checkout', ['id' => $id]))->with([
            'qty' => $qty,
        ]);
    }
    public function qr(string $id)
    {
        $product = DB::table('produk')->find($id);
        $path = 'img/qrcodes/';
        return response()->download(public_path($path . $product->qrcode_file));
    }

    public function all()
    {
        $categories = DB::table('categories')->get();
        $products = DB::table('produk')
            ->join('reviews', 'produk.id', '=', 'reviews.product_id')
            ->join('categories', 'categories.id', '=', 'produk.category_id')
            ->select(
                'produk.id as id',
                'produk.name as name',
                'produk.image as image',
                'produk.price as price',
                'categories.name as category',
                DB::raw('AVG(reviews.rating) as avg_rating')
            )->groupBy('produk.id', 'produk.name', 'produk.image', 'produk.price', 'categories.name')
            ->get();


        return view('welcome', compact('categories', 'products'));
    }

    public function filter($categoryId)
    {
        $categories = DB::table('categories')->get();
        $products = DB::table('produk')->where('category_id', $categoryId)->get();
        $activeCategory = $categoryId;

        return view('welcome', compact('categories', 'products', 'activeCategory'));
    }
}
