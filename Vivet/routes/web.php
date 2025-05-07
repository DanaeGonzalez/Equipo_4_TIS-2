<?php

namespace App\Http\Controllers;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing');
});

Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy-policy');

Route::view('/terms-of-service', 'pages.terms-of-service')->name('terms-of-service');

Route::view('/contact', 'pages.contact')->name('contact');

Route::view('/about-us', 'pages.about-us')->name('about');

Route::view('/faq', 'pages.faq')->name('faq');

Route::get('/registro', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'registerUser'])->name('register.submit');

Route::get('/inicio-sesion',[LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login',[LoginController::class, 'loginUser'])->name('login.submit');
Route::post('/logout', [LogoutController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware(['admin'])->group(function() {
    // Rutas que solo puede ver un administrador
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    // Otras rutas protegidas
    Route::get('/roles/{role}/permissions/edit', [PermissionController::class, 'editPermissions'])->name('roles.permissions.edit');
    Route::put('/roles/{role}/permissions', [PermissionController::class, 'updatePermissions'])->name('roles.permissions.update');

});
