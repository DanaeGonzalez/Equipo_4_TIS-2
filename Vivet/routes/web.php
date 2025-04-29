<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProfileController; // la puedes dejar comentada por ahora si no usas controlador todavía

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing');
});

// Rutas protegidas para usuarios normales (no superadmins)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
