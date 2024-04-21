<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Posts\CategoryController;
use App\Http\Controllers\Posts\CommentController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth:api',
], function () {
    Route::prefix('auth')->group(function () {
        Route::post('refresh', [LoginController::class, 'refresh']);
        Route::post('logout', [LogoutController::class, 'logout']);
        Route::get('current-user', [LoginController::class, 'currentUser']);
    });
    Route::resource('users', UserController::class)->except(['store', 'create']);
    Route::apiResource('categories', CategoryController::class);

    Route::group(['prefix' => 'posts'], function() {
        Route::apiResource('/', PostController::class);
        Route::post('/{post}/comments', [CommentController::class, 'store']);
        Route::patch('/comments/{comment}', [CommentController::class, 'update']);
        Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
    });
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [LoginController::class, 'login']);
});


