<?php
/*
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
/*
Route::middleware(['auth'])->group(function () {  

});

Route::middleware(['check.permission'])->group(function () {
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::post('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
    Route::post('/appointments/{appointment}/reactivate', [AppointmentController::class, 'reactivate'])->name('appointments.reactivate');
    
});

// Gestión de citas
/*Route::middleware(['auth'])->group(function () {
    Route::resource('appointments', AppointmentController::class);
});
*/