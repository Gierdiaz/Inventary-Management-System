<?php

use App\Http\Controllers\{
    CategoryController,
    ProductController,
    StockMovementController,
    SuppliersController,
    UserController};
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'store']);
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{user}', [UserController::class, 'show']);
    Route::put('/{user}', [UserController::class, 'update']);
    Route::delete('/{user}', [UserController::class, 'destroy']);
    Route::put('/{user}/assign-admin-role', [UserController::class, 'assignAdminRole']);
    Route::put('/{user}/revoke-admin-role', [UserController::class, 'revokeAdminRole']);
});

// Rotas relacionadas às categorias
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{category}', [CategoryController::class, 'show']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::put('/{category}', [CategoryController::class, 'update']);
    Route::delete('/{category}', [CategoryController::class, 'destroy']);
});

// Rotas relacionadas aos fornecedores
Route::prefix('suppliers')->group(function () {
    Route::get('/', [SuppliersController::class, 'index']);
    Route::get('/{supplier}', [SuppliersController::class, 'show']);
    Route::post('/', [SuppliersController::class, 'store']);
    Route::put('/{supplier}', [SuppliersController::class, 'update']);
    Route::delete('/{supplier}', [SuppliersController::class, 'destroy']);
});

// Rotas relacionadas aos produtos
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{product}', [ProductController::class, 'show']);
    Route::post('/', [ProductController::class, 'store']);
    Route::put('/{product}', [ProductController::class, 'update']);
    Route::delete('/{product}', [ProductController::class, 'destroy']);
});

// Rotas relacionadas ao movimento de estoque
Route::prefix('stock-movements')->group(function () {
    Route::get('/', [StockMovementController::class, 'index']);
    Route::get('/{stockMovement}', [StockMovementController::class, 'show']);
    Route::post('/', [StockMovementController::class, 'store']);
    Route::put('/{stockMovement}', [StockMovementController::class, 'update']);
    Route::delete('/{stockMovement}', [StockMovementController::class, 'destroy']);
});
