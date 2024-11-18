<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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


// Products page
Route::get('/products', function () {


    return view('products');
});


use App\Http\Controllers\SignupController;

Route::get('/signup', [SignupController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');




