<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Posts\CategoryController;
use App\Http\Controllers\Posts\CommentController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Posts\UserPostController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
], function () {
    Route::get('users/{user}/posts', [UserPostController::class, 'showUserPosts']);
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{post}', [PostController::class, 'show']);
});


Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth'
], function () {
    Route::post('refresh', [LoginController::class, 'refresh']);
    Route::post('logout', [LogoutController::class, 'logout']);
    Route::get('current-user', [LoginController::class, 'currentUser']);
});


Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'users'
], function () {
    Route::resource('', UserController::class)->except(['store', 'create'])->parameters([
        '' => 'user'
    ]);
    Route::post('/{user}/follow', [UserController::class, 'follow']);
    Route::post('/{user}/un-follow', [UserController::class, 'unFollow']);
    Route::get('/{user}/followers', [UserController::class, 'showFollowers']);
    Route::get('/{user}/authors', [UserController::class, 'showAuthors']);
});


Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'posts'
], function () {
    Route::get('/archived', [UserPostController::class, 'showArchivedPostsForCurrentUser']);

    Route::apiResource('', PostController::class)->parameters([
        '' => 'post'
    ])->except(['index', 'show']);
    Route::post('/{post}/comments', [CommentController::class, 'store']);
    Route::patch('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

    Route::patch('/{post}/archive', [UserPostController::class, 'archivePost']);
    Route::patch('/{post}/un-archive', [UserPostController::class, 'unArchivePost']);

    Route::post('/{post}/view', [UserPostController::class, 'watch']);
});


Route::group([
    'middleware' => 'auth:api',
], function () {
    Route::apiResource('categories', CategoryController::class);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [LoginController::class, 'login']);
});
