<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create' , compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'id_category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);
        $imagePath = 'images/' . $imageName;

        Product::create([
            'product' => $request->product,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'id_category' => $request->id_category,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id_product)
    {
        $product = Product::findOrFail($id_product);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public');
        $product->image = 'storage/' . $imagePath;
    }

    $product->product = $request->product;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->id_category = $request->id_category;

    $product->save();
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('products.index');
    }
}
