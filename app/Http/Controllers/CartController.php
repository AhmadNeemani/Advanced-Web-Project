<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class CartController extends Controller
{
   
    public function handleCart(Request $request, $productId)
{

    $userId = Auth::id();
    \Log::info('Auth Check:', [
        'userId' => Auth::id(),
        'isAuthenticated' => Auth::check(),
        'sessionId' => session()->getId(),
    ]);
    

    \Log::info('User Authentication Debug:', [
        'isLoggedIn' => Auth::check(),
        'userId' => $userId,
    ]);

    if (!$userId) {
        return response()->json(['success' => false, 'message' => 'User not logged in']);
    }

    $product = Product::findOrFail($productId);

    // Validate the requested quantity
    $quantity = $request->input('quantity');
    if ($quantity < 1 || $quantity > min(10, $product->quantity)) {
        return response()->json(['success' => false, 'message' => 'Invalid quantity']);
    }

    // Check if the product already exists in the cart
    $cartItem = \DB::table('carts')
        ->where('customer_id', $userId)
        ->where('product_id', $productId)
        ->first();

    if ($cartItem) {
        // Update the existing cart item
        \DB::table('carts')
            ->where('id', $cartItem->id)
            ->update(['quantity' => $quantity, 'updated_at' => now()]);
    } else {
        // Add the new product to the cart
        \DB::table('carts')->insert([
            'customer_id' => $userId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return response()->json(['success' => true, 'message' => 'Cart updated successfully', 'quantity' => $quantity]);
}


public function getCartQuantity($productId)
{
    $user = Auth::user();

    \Log::info('Fetching cart quantity', [
        'userId' => $user ? $user->id : 'Guest',
        'authStatus' => Auth::check() ? 'Authenticated' : 'Not Authenticated',
        'productId' => $productId,
    ]);

    if (!$user) {
        return response()->json(['success' => false, 'quantity' => 0, 'message' => 'User not logged in']);
    }

    $cartItem = DB::table('carts')
        ->where('customer_id', $user->id)
        ->where('product_id', $productId)
        ->first();

    $quantity = $cartItem ? $cartItem->quantity : 0;

    \Log::info('Cart quantity fetched successfully', [
        'userId' => $user->id,
        'productId' => $productId,
        'quantity' => $quantity,
    ]);

    return response()->json(['success' => true, 'quantity' => $quantity]);
}


    

    public function removeFromCart($productId)
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'User not authenticated']);
        }

        DB::table('carts')->where('customer_id', $userId)->where('product_id', $productId)->delete();

        return response()->json(['success' => true, 'message' => 'Product removed from cart']);
    }

    public function addOrIncrementCart(Request $request, $productId)
{
    $userId = Auth::id();

    \Log::info('User Info:', [
        'userId' => $userId,
        'isAuthenticated' => Auth::check(),
    ]);

    if (!$userId) {
        return response()->json(['success' => false, 'message' => 'User not logged in']);
    }

    $product = Product::findOrFail($productId);

    // Check if the product already exists in the cart
    $cartItem = \DB::table('carts')
        ->where('customer_id', $userId)
        ->where('product_id', $productId)
        ->first();

    if ($cartItem) {
        // Increment the quantity if it's already in the cart
        if ($cartItem->quantity < $product->quantity) {
            \DB::table('carts')
                ->where('id', $cartItem->id)
                ->update([
                    'quantity' => $cartItem->quantity + 1,
                    'updated_at' => now(),
                ]);
        } else {
            return response()->json(['success' => false, 'message' => 'No more stock available']);
        }
    } else {
        // Add the product to the cart if it's not already there
        if ($product->quantity > 0) {
            \DB::table('carts')->insert([
                'customer_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Product is out of stock']);
        }
    }

    // Fetch the updated cart quantity for the product
    $updatedCartItem = \DB::table('carts')
        ->where('customer_id', $userId)
        ->where('product_id', $productId)
        ->first();

    return response()->json([
        'success' => true,
        'message' => 'Product added to cart or incremented successfully!',
        'quantity' => $updatedCartItem->quantity,
    ]);
}

}
