<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // Add this for logging

class AdminController extends Controller
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
    // Log the incoming request data for debugging
    Log::info('Add Product Request Data: ', $request->all());

    // Validate the incoming request
    $validated = $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'description' => 'nullable',
        'category_id' => 'required|exists:categories,id', 
        'quantity' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    // Debugging: Log validated data
    Log::info('Validated Product Data: ', $validated);

    // Handle Image Upload
    $imagePath = null;
    if ($request->hasFile('image')) {
        // Store the image in the 'public' disk (storage/app/public)
        try {
            $imagePath = $request->file('image')->store('product_images', 'public');
            Log::info('Image successfully stored: ', ['image_path' => $imagePath]);
        } catch (\Exception $e) {
            // Log any errors that happen during image storage
            Log::error('Error storing image: ' . $e->getMessage());
        }
    } else {
        Log::warning('No image uploaded');
    }

    // Create the product in the database
    try {
        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'], 
            'quantity' => $validated['quantity'],
            'image' => $imagePath, 
        ]);

        // Log success
        Log::info('Product successfully added');
    } catch (\Exception $e) {
        // Log any errors during product creation
        Log::error('Error adding product: ' . $e->getMessage());
    }

    return redirect()->route('admin')->with('success', 'Product added successfully');
}


    // Edit and update product
    public function edit($id)
    {
        $product = Product::findOrFail($id); 
        $categories = Category::all(); 
        return view('edit-product', compact('product', 'categories'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        // Log the incoming request data for debugging
        Log::info('Update Product Request Data: ', $request->all());
    
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id', 
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
    
        // Log validated data
        Log::info('Validated Update Data: ', $validated);
    
        $product = Product::findOrFail($id);
    
        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image); // Delete old image
            }
            // Store the new image and update the path
            $validated['image'] = $request->file('image')->store('product_images', 'public');
            Log::info('Updated Image Path: ', ['image_path' => $validated['image']]);
        } else {
            // Keep the existing image if no new image is uploaded
            $validated['image'] = $product->image;
        }
    
        // Update the product in the database
        try {
            $product->update($validated);
            Log::info('Product successfully updated');
        } catch (\Exception $e) {
            Log::error('Error updating product: ' . $e->getMessage());
        }
    
        return redirect()->route('productadmin.index')->with('success', 'Product updated successfully');
    }
    


    // Delete product
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            // Log success
            Log::info('Product successfully deleted: ', ['product_id' => $id]);
        } catch (\Exception $e) {
            // Log failure if something goes wrong
            Log::error('Error deleting product: ' . $e->getMessage());
        }

        return redirect()->route('admin')->with('success', 'Product deleted successfully');
    }
}
