<?php

namespace App\Http\Controllers;

use App\Models\Product;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    //
    public function show(string $id)
    {

        $product = Product::find($id);
        return view('pages.detail', ['product' => $product]);
    }
    public function qr(string $id)
    {
        $product = Product::find($id);
        $path = 'img/qrcodes/';
        return response()->download(public_path($path . $product->qrcode_file));
    }
}
