<?php

use App\Http\Controllers\{CategoryController, SuppliersController, UserController};
use Illuminate\Support\Facades\Route;

Route::post('/users', [UserController::class, 'store']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::post('/users/{user}', [UserController::class, 'destroy']);

Route::put('/users/{user}/assign-admin-role', [UserController::class, 'assignAdminRole']);
Route::put('/users/{user}/revoke-admin-role', [UserController::class, 'revokeAdminRole']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{category}', [CategoryController::class, 'update']);
Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

Route::get('/suppliers', [SuppliersController::class, 'index']);
Route::get('/suppliers/{supplier}', [SuppliersController::class, 'show']);
Route::post('/suppliers', [SuppliersController::class, 'store']);
Route::put('/suppliers/{supplier}', [SuppliersController::class, 'update']);
Route::delete('/suppliers/{supplier}', [SuppliersController::class, 'destroy']);
