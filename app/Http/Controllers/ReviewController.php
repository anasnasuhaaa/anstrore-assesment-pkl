<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    //
    public function index(string $id)
    {
        $product = DB::table('produk')->find($id);

        return view('pages.orderlist.review', compact('product'));
    }
    public function store(Request $request, string $id)
    {

        $request->validate([
            'rating' => 'required',
            'review' => 'required',
        ]);

        $data = [
            'rating' => $request->input('rating'),
            'review' => $request->input('review'),
            'product_id' => $id,
            'user_id' => auth()->user()->id,
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::table('reviews')->insert($data);

        return redirect()->route('product.detail', $id)->with('message-success-review', 'Berhasil menambahkan ulasan');
    }
}
