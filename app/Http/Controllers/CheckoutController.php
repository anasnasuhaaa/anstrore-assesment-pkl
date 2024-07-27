<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function index(string $id)

    {
        $product = Product::findOrFail($id);
        return view('pages.checkout', ['product' => $product]);
    }
}
