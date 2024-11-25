<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect('/login')->with('error', 'You need to log in first.');
        }
    
        // Fetch the cart items for the logged-in user
        $cartItems = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.customer_id', $userId)
            ->select(
                'products.id as product_id',
                'products.name',
                'products.image',
                'products.quantity as stock',
                'carts.quantity as cart_quantity',
                'products.price'
            )
            ->get();
    
        if ($cartItems->isEmpty()) {
            return redirect()->route('products.index')->with('info', 'Your cart is empty.');
        }
    
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->cart_quantity;
        });
        
        return view('orders', compact('cartItems', 'totalPrice'));
        
    }
    

    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $userId = Auth::id();
        $productId = $request->input('product_id');
        $newQuantity = $request->input('quantity');
    
        $product = Product::findOrFail($productId);
    
        if ($newQuantity > $product->quantity) {
            return response()->json(['success' => false, 'message' => 'Quantity exceeds stock availability']);
        }
    
        DB::table('carts')
            ->where('customer_id', $userId)
            ->where('product_id', $productId)
            ->update(['quantity' => $newQuantity]);
    
        return response()->json(['success' => true, 'message' => 'Cart updated successfully']);
    }

    

public function removeFromCart($productId)
{
    $userId = Auth::id();

    if (!$userId) {
        return response()->json(['success' => false, 'message' => 'User not authenticated']);
    }

    DB::table('carts')->where('customer_id', $userId)->where('product_id', $productId)->delete();

    return response()->json(['success' => true, 'message' => 'Item removed successfully']);
}



public function placeOrder(Request $request)
{
    $userId = Auth::id();
    if (!$userId) {
        return response()->json(['success' => false, 'message' => 'User not logged in']);
    }

    $cartItems = DB::table('carts')
        ->where('customer_id', $userId)
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->select('carts.product_id', 'carts.quantity', 'products.price')
        ->get();

    if ($cartItems->isEmpty()) {
        return response()->json(['success' => false, 'message' => 'Cart is empty']);
    }

    $total = $cartItems->sum(function ($item) {
        return $item->quantity * $item->price;
    });

    // Create the order
    $order = Order::create([
        'customer_id' => $userId,
        'total' => $total,
        'address' => $request->address,
    ]);

    // Attach products to the order
    foreach ($cartItems as $item) {
        $order->items()->create([
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'price' => $item->price,
        ]);
    }

    // Clear the user's cart
    DB::table('carts')->where('customer_id', $userId)->delete();

    return response()->json(['success' => true, 'message' => 'Order placed successfully']);
}


}
