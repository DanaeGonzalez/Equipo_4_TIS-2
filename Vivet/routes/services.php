<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;

// Servicios disponibles
Route::middleware(['auth'])->group(function () {
    Route::resource('services', ServiceController::class);
});
