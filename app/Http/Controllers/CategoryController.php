<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    //

    public function index()
    {
        $category = DB::table('categories')->get();
        return view('admin.category.index', ['category' => $category]);
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        try {

            $request->validate([
                'category' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg'
            ]);

            // Save Image as a File in Public Path
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/category'), $filename);

            $data = [
                'name' => $request->input('category'),
                'image' => $filename,
                'created_at' => now(),
                'updated_at' => now()
            ];

            DB::table('categories')->insert($data);

            return redirect(route('admin.category'))->with('success-added', "Berhasil Menambahkan $request->category");
        } catch (Throwable $caught) {
            dd($caught);
        }
    }

    public function edit(string $id)
    {
        $category = DB::table('categories')->find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
        ]);

        $category = DB::table('categories')->where('id', $id)->first();

        $data = [
            'name' => $request->input('category')
        ];

        if ($request->has('image')) {
            $path = "img/category/";
            File::delete($path . $category->image);

            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/category'), $filename);

            $data['image'] = $filename;
        }

        DB::table('categories')->where('id', $id)->update($data);
        return redirect(route('admin.category'))->with('success-updated', 'Kategori berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $category = DB::table('categories')->find($id);
        $path = "img/category/";
        File::delete($path . $category->image);
        DB::table('categories')->where('id', $id)->delete();

        return redirect(route('admin.category'))->with('success-deleted', "$category->name berhasil dihapus");;
    }
}
