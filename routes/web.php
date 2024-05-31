<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rotas relacionadas aos produtos
// Route::get('/products', [ProductController::class, 'index'])->name('products.index');
