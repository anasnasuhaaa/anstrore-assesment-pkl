<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $products = DB::table('produk')->orderBy('created_at', 'desc')
            ->join('categories', 'categories.id', '=', 'produk.category_id')
            ->select('produk.*', 'categories.name as category_name')
            ->paginate(5);

        foreach ($products as $product) {
            $product->created_at = Carbon::parse($product->created_at);
        }

        return view('admin.product.index', compact('products'));
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $category = DB::table('categories')->orderBy('name', 'asc')->get();
        return view('admin.product.create', compact('category'));
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

        // Image Filename and Save to public path
        $filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img/product'), $filename);

        // QR Code file name
        $qr_filename = time() . '.' . 'png';

        $data = [
            "name" => $request->input('name'),
            "category_id" => $request->input('category_id'),
            "description" => $request->input('description'),
            "price" => $request->input('price'),
            "stock" => $request->input('stock'),
            "image" => $filename,
            "qrcode_file" => $qr_filename,
            "created_at" => now(),
            "updated_at" => now()
        ];

        $productId = DB::table('produk')->insertGetId($data);

        // QR Code generate
        $qr = QrCode::size(200)->format('png')->generate(url('product/' . $productId));
        $path = public_path('img/qrcodes');
        // Simpan QR code ke file
        File::put($path . '/' . $qr_filename, $qr);
        return redirect()->route('admin.product.index')->with('success-added', 'Produk berhasil ditambahkan');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = DB::table('produk')->where('produk.id', $id)
            ->join('categories', 'categories.id', '=', 'produk.category_id')
            ->select('produk.*', 'categories.name as category_name')
            ->first();
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = DB::table('produk')->where('id', $id)->first();
        $category = DB::table('categories')->get();
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

        $product = DB::table('produk')->find($id);

        $data = [
            "name" => $request->input('name'),
            "category_id" => $request->input('category_id'),
            "description" => $request->input('description'),
            "price" => $request->input('price'),
            "stock" => $request->input('stock'),
            "created_at" => now(),
            "updated_at" => now()
        ];

        if ($request->has('image')) {
            $path = 'img/product/';
            File::delete($path . $product->image);
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/product'), $filename);
            $data["image"] = $filename;
        };

        DB::table('produk')->where('id', $id)->update($data);

        return redirect()->route('admin.product.index')->with('success-updated', 'Produk berhasil diupdate');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('order_details')->where('product_id', $id)->delete();
        DB::table('reviews')->where('product_id', $id)->delete();

        $product = DB::table('produk')->find($id);

        // Remove Image file in Public path
        $img_path = 'img/product/';
        File::delete($img_path . $product->image);
        $qr_path = 'img/qrcodes/';
        File::delete($qr_path . $product->qrcode_file);

        DB::table('produk')->where('id', $id)->delete();

        return redirect(route('admin.product.index'))->with('success-deleted', 'Produk berhasil dihapus');
    }
    public function export()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }
}
