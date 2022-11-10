<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'showPosts']);
    Route::get('{post}', [PostController::class, 'show']);
    Route::delete('{post}', [PostController::class, 'delete']);
});

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
    Route::prefix('dashboard')-> group(function(){
        Route::apiResource('categories', CategoryController::class);
    });
});
