<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Web Authentication
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('inventory')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Products
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::get('/new', [ProductController::class, 'create'])->name('newProduct');
        Route::post('/create', [ProductController::class, 'store'])->name('storeProduct');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::post('/{product}/update', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    // Categories
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::get('/new', [CategoryController::class, 'create'])->name('newCategory');
        Route::post('/create', [CategoryController::class, 'store'])->name('storeCategory');
    });

    // Units
    Route::prefix('units')->group(function () {
        Route::get('/', [UnitController::class, 'index'])->name('units');
        Route::get('/new', [UnitController::class, 'create'])->name('newUnit');
        Route::post('/create', [UnitController::class, 'store'])->name('storeUnit');
    });
});
