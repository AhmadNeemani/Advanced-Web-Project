<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request, $productId)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not logged in']);
        }

        // Check if the product exists
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found']);
        }

        // Toggle the favorite status
        $isFavorite = $user->favorites()->toggle($productId);

        $favorited = count($isFavorite['attached']) > 0; // Check if it was added or removed

        return response()->json([
            'success' => true,
            'isFavorite' => $favorited,
        ]);
    }
}
