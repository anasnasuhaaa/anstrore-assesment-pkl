<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use File;
use PhpParser\Node\Stmt\Catch_;
use Throwable;

class CategoryController extends Controller
{
    //

    public function index()
    {
        $category = Category::all();
        return view('admin.category.index', ['category' => $category]);
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        try {
            $category = new Category();

            $request->validate([
                'category' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg'
            ]);

            // Save Image as a File in Public Path
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/category'), $filename);

            $category->name = $request->category;
            $category->image = $filename;
            $category->save();

            return redirect(route('admin.category'));
        } catch (Throwable $caught) {
            dd($caught);
        }
    }

    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', ['category' => $category]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
        ]);

        $category = Category::find($id);

        if ($request->has('image')) {
            $path = "img/category/";
            File::delete($path . $category->image);

            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/category'), $filename);

            $category->image = $filename;
            $category->save();
        }
        $category->name = $request->category;
        $category->save();
        return redirect(route('admin.category'));
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);
        $path = "img/category/";
        File::delete($path . $category->image);
        $category->delete();
        return redirect(route('admin.category'));
    }
}
