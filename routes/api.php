<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\CartController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;


Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/register', [UserAuthController::class, 'register']); 

Route::get('/optimize', function () {
    \Artisan::call('optimize');
    return 'Application optimized successfully!';
});

Route::get('/migrate', function () {
    \Artisan::call('migrate');
    return 'Database migrated successfully!';
});

Route::get('/migrate', function () {
    \Artisan::call('migrate');
    return 'Database migrated successfully!';
});

Route::get('/generate-key', function () {
    try {
        Artisan::call('key:generate', ['--force' => true]);
        return response()->json(['message' => 'Application key generated successfully.'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::get('/migrate-force', function () {
    \Artisan::call('migrate', ['--force' => true]);
    return 'Database migrated with force!';
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'product']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'category']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [UserAuthController::class, 'logout']);

    // Cart Endpoints
    Route::get('/cart', [App\Http\Controllers\Api\CartController::class, 'ViewCart']);
    Route::post('/cart', [App\Http\Controllers\Api\CartController::class, 'AddToCart']);
    Route::put('/cart/{cartItem}', [App\Http\Controllers\Api\CartController::class, 'UpdateCart']);
    Route::delete('/cart/{cartItem}', [App\Http\Controllers\Api\CartController::class, 'RemoveItemCart']);
    Route::delete('/cart', [App\Http\Controllers\Api\CartController::class, 'ClearCart']);
});

