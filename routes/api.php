<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::controller(AuthController::class)
    ->prefix('auth')
    ->group(function () {
        Route::post('/login', 'login')
            ->name('login');
        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout')
            ->middleware('auth:api');
    });

Route::controller(PostController::class)
    ->prefix('posts')
    ->middleware('auth:api')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{post}', 'show');

        Route::post('/', 'store');
        Route::put('/{post}', 'update');
        Route::delete('/{post}', 'destroy');
        // Route::patch('/{post}', 'updateTags');
    });
