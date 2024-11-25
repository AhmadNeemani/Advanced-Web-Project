<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;




// Home page
Route::get('/', function () {
    return view('index');
})->name('home');

// Login and logout routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard route (protected by auth middleware)
Route::get('/dashboard', function () {
    return 'Welcome to your dashboard!';
})->middleware('auth')->name('dashboard');

// Admin dashboard (protected by auth middleware)
Route::get('/admin-dashboard', function () {
    return view('admin-dashboard');
})->middleware('auth')->name('admin-dashboard');

// Quiz route
Route::get('/quiz', function () {
    return view('quiz');
});

// Personality test route
Route::get('/personality', function () {
    return view('personalitytst');
});

// Test route
Route::get('/test', function () {
    return view('testbegin');
});


// ProductList Routes

Route::get('/productsList', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');





// Sign Up Routes

Route::get('/signup', [SignupController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');


// Cart and Favorits Route

Route::post('/favorites/toggle/{product}', [FavoriteController::class, 'toggleFavorite'])->name('favorites.toggle');

Route::middleware(['web'])->group(function () {
Route::post('/cart/handle/{product}', [CartController::class, 'handleCart']);
Route::get('/cart/quantity/{productId}', [CartController::class, 'getCartQuantity']);
Route::delete('/cart/remove/{product}', [CartController::class, 'removeFromCart']);
Route::post('/cart/add-or-increment/{product}', [CartController::class, 'addOrIncrementCart'])->name('cart.addOrIncrement');

});



Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/update-cart', [OrderController::class, 'updateCart'])->name('orders.updateCart');
    Route::delete('/orders/remove/{productId}', [OrderController::class, 'removeFromCart'])->name('orders.remove');
    Route::post('/orders/place', [OrderController::class, 'placeOrder'])->name('orders.place');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/orders/update-cart', [OrderController::class, 'updateCart'])->name('orders.updateCart');
    Route::delete('/orders/remove/{productId}', [OrderController::class, 'removeFromCart'])->name('orders.remove');
});


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');









