<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\ClinicController;

// Panel Superadmin
Route::prefix('sa')->name('superadmin.')->middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('clinics', ClinicController::class);
});
