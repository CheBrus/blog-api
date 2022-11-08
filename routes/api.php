<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'showPosts']);
    Route::get('{post}', [PostController::class, 'show']);
});

