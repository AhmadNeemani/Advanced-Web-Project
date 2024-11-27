<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Display products and categories in the admin panel
    public function index()
    {
        $products = Product::orderBy('price')->get();
        $categories = Category::all(); 

        return view('admin', compact('products', 'categories'));
    }

    // Add product
        public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id', 
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('product_images', 'public') 
            : null;

        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'], 
            'quantity' => $validated['quantity'],
            'image' => $imagePath, 
        ]);

        return redirect()->route('admin')->with('success', 'Product added successfully');
    }

    // Edit and update product
    public function edit($id)
    {
        $product = Product::findOrFail($id); 
        $categories = Category::all(); 

        return view('edit-product', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id', 
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')->store('product_images', 'public');
        } else {
            $validated['image'] = $product->image;
        }

        $product->update($validated);

        return redirect()->route('admin')->with('success', 'Product updated successfully');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin')->with('success', 'Product deleted successfully');
    }
}
