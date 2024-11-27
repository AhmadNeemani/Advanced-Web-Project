<?php

use App\Http\Controllers\ProductController; // import the ProductController

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

// Admin Panel Route - Passing products to the view
Route::get('/admin', [ProductController::class, 'index'])->name('admin');

// Quiz and Personality routes
Route::get('/quiz', function () {
    return view('quiz');
});

Route::get('/personality', function () {
    return view('personalitytst');
});

Route::get('/test', function () {
    return view('testbegin');
});

// Product Routes
Route::get('/productsList', function () {
    return view('products');
});

Route::get('/products', [ProductController::class, 'index']);

// Edit, update, and delete product routes
Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit-product');
Route::put('/edit-product/{id}', [ProductController::class, 'update'])->name('update-product'); // Use PUT for update
Route::post('/add-product', [ProductController::class, 'store'])->name('add-product');
Route::post('/delete-product/{id}', [ProductController::class, 'destroy'])->name('delete-product');
