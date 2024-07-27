<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleSoftwareIO\QrCode\Generator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //



        $products = Product::all();

        return view('admin.product.index', ['product' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $category = Category::all()->sortBy('name');
        return view('admin.product.create', ['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,)
    {
        $product = new Product();
        $request->validate([
            "name" => 'required',
            "category_id" => 'required',
            "description" => 'required',
            "price" => 'required',
            "stock" => 'required',
            "image" => 'required|image|mimes:jpg,png,jpeg'
        ]);
        // image
        $filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img/product'), $filename);

        $qr_filename = time() . '.' . 'png';


        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->image = $filename;
        $product->qrcode_file = $qr_filename;
        $product->save();
        // QR Code
        $qr = QrCode::size(200)->format('png')->generate(url('product/' . $product->id),);
        $path = public_path('img/qrcodes');
        // Pastikan direktori ada
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
        // Simpan QR code ke file
        File::put($path . '/' . $qr_filename, $qr);

        return redirect()->route('product.index')->with('success-added', 'Produk berhasil ditambahkan');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = Product::find($id);
        return view('admin.product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = Product::find($id);
        $category = Category::where('name', '!=', $product->category->name)->get();
        return view('admin.product.edit', ['product' => $product, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            "name" => 'required',
            "category_id" => 'required',
            "description" => 'required',
            "price" => 'required',
            "stock" => 'required',
            "image" => 'image|mimes:jpg,png,jpeg'
        ]);

        $product = Product::find($id);
        if ($request->has('image')) {
            $path = 'img/product/';

            File::delete($path . $product->image);
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/product'), $filename);
            $product->image = $filename;
            $product->save();
        };

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('product.index')->with('success-updated', 'Produk berhasil diupdate');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id);

        // Remove Image file in Public path
        $img_path = 'img/product/';
        File::delete($img_path . $product->image);
        $qr_path = 'img/qrcodes/';
        File::delete($qr_path . $product->qrcode_file);

        $product->delete();
        return redirect(route('product.index'))->with('success-deleted', 'Produk berhasil dihapus');
    }
}
