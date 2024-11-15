<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

route::get('/quiz', function () {
    return view('quiz');
});

route::get('/personality', function () {
    return view('personalitytst');
});


route::get('/test', function () {
    return view('testbegin');
});

Route::get('/productsList', function () {
    return view('products');
});



