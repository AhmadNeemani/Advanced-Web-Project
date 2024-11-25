<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // To handle database operations
use App\Models\Product;

class ProductController extends Controller
{
    
    public function index()
    {
        $user = Auth::user(); // Get the currently authenticated user (if any)

        // Fetch all products and determine if they are favorited by the user
        $products = Product::all()->map(function ($product) use ($user) {
            $product->isFavorite = $user ? $user->favorites->contains($product->id) : false;
            return $product;
        });

        return view('products', compact('products')); // Pass products to the view
    }

  
    public function show($id)
{
    $user = Auth::user();

    $product = Product::with('category')->findOrFail($id);

    $product->isFavorite = $user ? $user->favorites->contains($product->id) : false;

    $cartQuantity = 0;
    if ($user) {
        $cartItem = DB::table('carts')
            ->where('customer_id', $user->id)
            ->where('product_id', $id)
            ->first();
        $cartQuantity = $cartItem ? $cartItem->quantity : 0;
    }

    // Debugging cartQuantity
    \Log::info('Cart Quantity:', ['productId' => $id, 'userId' => $user->id ?? null, 'cartQuantity' => $cartQuantity]);

    return view('show', compact('product', 'cartQuantity'));
}

}
