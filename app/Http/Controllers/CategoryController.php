<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required']
        ]);

        $category = new Category;
        $category->category = $request->input('category');
        $category->save();

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {

        $category = Category::find($id);
        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, $id_category)
    {
        $category = Category::find($id_category);
        $category->category = $request->category;
        $category->save();
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('categories.index');
    }
}
