<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $category = Category::all()->sortBy('name');
        foreach ($category as $key => $value) {
        }
        return view('admin.category.index', ['category' => $category]);
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ]);

        $category = new Category();

        $category->name = $request->category;
        $category->save();

        return redirect(route('admin.category'));
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
        ]);
        $category = Category::find($id);
        $category->name = $request->category;
        $category->save();
        return redirect(route('admin.category'));
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect(route('admin.category'));
    }
}
