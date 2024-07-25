<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('/login', 'login')
        ->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout')
        ->middleware('auth:api');
});

// Route::controller(ProductController::class)->group(function () {
//     Route::get('/products', 'index');
//     Route::get('/products/{id}', 'show');
//     Route::get('/products/search/{name}', 'search');
// });

// Route::middleware('auth:api')->group(function () {
//     Route::controller(ProductController::class)->group(function () {
//         Route::post('/products', 'store');
//         Route::post('/products/{id}', 'update');
//         Route::delete('/products/{id}', 'destroy');
//     });
// });
