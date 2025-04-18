// routes/web.php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Página principal (index.html -> welcome.blade.php)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Páginas estáticas
Route::prefix('pages')->group(function () {
    Route::get('/about', function () {
        return view('pages.about');
    })->name('about');

    Route::get('/contact', function () {
        return view('pages.contact');
    })->name('contact');

    Route::get('/pricing', function () {
        return view('pages.pricing');
    })->name('pricing');
});

// Blog
Route::prefix('blog')->group(function () {
    Route::get('/grids', function () {
        return view('blog.grids');
    })->name('blog.grids');

    Route::get('/details/{id}', function ($id) {
        return view('blog.details', ['id' => $id]);
    })->name('blog.details');
});

// Autenticación
Route::prefix('auth')->group(function () {
    Route::get('/signin', function () {
        return view('auth.signin');
    })->name('auth.signin');

    Route::get('/signup', function () {
        return view('auth.signup');
    })->name('auth.signup');
});

// Manejo de errores (404.html)
Route::fallback(function () {
    return view('errors.404');
});