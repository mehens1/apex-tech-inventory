<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserAuthController;
use Illuminate\Support\Facades\Artisan;

Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/register', [UserAuthController::class, 'register']);

Route::prefix('user')->middleware('auth:api')->group(function () {
    Route::get('/', [UserAuthController::class, 'profile']);
    Route::post('/logout', [UserAuthController::class, 'logout']);
    Route::put('/update', [UserAuthController::class, 'updateProfile']);
});

Route::prefix('cart')->middleware('auth:api')->group(function () {
    Route::post('/', [ProductController::class, 'store']); // Consider using a CartController if handling cart logic
});


// Product routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'product']);
});

// Category routes
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'category']);
});
