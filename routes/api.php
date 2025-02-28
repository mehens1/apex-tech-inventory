<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CheckoutController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\EmailController;

Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/forgot-password', [UserAuthController::class, 'forgetPassword']);
Route::post('/reset-password', [UserAuthController::class, 'resetPassword']);
Route::post('/checkout', [CheckoutController::class, 'placeorder']);
// Route::get('/order', [CheckoutController::class, 'verifyPayment']);
Route::get('/order', [CheckoutController::class, 'CallBack']);

Route::prefix('user')->middleware('auth:api')->group(function () {
    Route::get('/', [UserAuthController::class, 'profile']);
    Route::post('/logout', [UserAuthController::class, 'logout']);
    Route::put('/update', [UserAuthController::class, 'updateProfile']);
    Route::put('/change-password', [UserAuthController::class, 'changePassword']);

    // Cart
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/', [CartController::class, 'store']);
    });

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
