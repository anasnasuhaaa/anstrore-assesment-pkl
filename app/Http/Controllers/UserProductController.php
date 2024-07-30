<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use BaconQrCode\Encoder\QrCode;
use PhpParser\Node\Expr\Cast\String_;

class UserProductController extends Controller
{
    //
    public function show(string $id)
    {

        $product = Product::find($id);

        $review = Review::where('product_id', $id)->get();
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
        $product = Product::find($id);
        $path = 'img/qrcodes/';
        return response()->download(public_path($path . $product->qrcode_file));
    }

    public function all()
    {
        $categories = Category::all();
        $products = Product::all();

        return view('welcome', compact('categories', 'products'));
    }

    public function filter($categoryId)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $categoryId)->get();
        $activeCategory = $categoryId;

        return view('welcome', compact('categories', 'products', 'activeCategory'));
    }
}
