<?php

namespace App\Http\Controllers;

use File;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with('category')->get();
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
    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "category_id" => 'required',
            "description" => 'required',
            "price" => 'required',
            "stock" => 'required',
            "image" => 'required|image|mimes:jpg,png,jpeg'
        ]);


        $filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img/product'), $filename);


        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->image = $filename;
        $product->save();


        return redirect()->route('product.index')->with('success', 'Product created successfully!');
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

        return redirect()->route('product.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id);

        $path = 'img/product/';
        File::delete($path . $product->image);

        $product->delete();

        return redirect(route('product.index'));
    }
}
