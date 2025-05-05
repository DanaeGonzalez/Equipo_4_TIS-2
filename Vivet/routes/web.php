<?php

namespace App\Http\Controllers;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::middleware(['admin'])->group(function() {
    // Rutas que solo puede ver un administrador
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    // Otras rutas protegidas
    // Rutas para asignar permisos a roles (solo administradores)
    Route::get('/roles/{role}/permissions/edit', [PermissionController::class, 'editPermissions'])->name('roles.permissions.edit');
    Route::put('/roles/{role}/permissions', [PermissionController::class, 'updatePermissions'])->name('roles.permissions.update');

});
