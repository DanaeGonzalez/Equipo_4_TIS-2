<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;

// Configuración general de la clínica
Route::middleware(['auth'])->group(function () {
    Route::resource('settings', SettingController::class);
});
