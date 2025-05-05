<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCategoryController;

// Blog y noticias
Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('post-categories', PostCategoryController::class);
});
