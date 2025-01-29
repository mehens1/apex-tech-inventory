<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;


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

// Route::get('/reset-migrations', function () {
//     Artisan::call('migrate:reset', ['--force' => true]);
//     Artisan::call('migrate', ['--force' => true]);
//     Artisan::call('db:seed', ['--force' => true]);
//     return 'Migrations reset, database migrated, and seeded successfully!';
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'product']);
});
