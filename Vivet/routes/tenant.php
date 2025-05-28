<?php
//declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BillingController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Estas rutas son cargadas por el TenantRouteServiceProvider automáticamente
| y ya tienen tenancy activado (InitializeTenancyByDomain).
|
*/

Route::get('/check', fn () => 'TENANT: ' . tenant('id'));

Route::get('/', function () {
    return view('tenant.landing');
});

Route::middleware(['auth', 'is_active'])->group(function () {
    //
});

Route::view('/privacy-policy', 'tenant.pages.privacy-policy')->name('tenant.privacy-policy');

Route::view('/terms-of-service', 'tenant.pages.terms-of-service')->name('tenant.terms-of-service');

Route::view('/contact', 'tenant.pages.contact')->name('tenant.contact');

Route::view('/blog', 'tenant.blog.index')->name('tenant.blog');

Route::view('/about-us', 'tenant.pages.about-us')->name('tenant.about');

Route::view('/faq', 'tenant.pages.faq')->name('tenant.faq');

Route::get('/register-form', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'registerUser'])->name('register.submit');

Route::get('/login-form', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'loginUser'])->name('login.submit');
Route::post('/logout', [LogoutController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware(['check.permission'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('tenant.users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('/roles/{role}/permissions/edit', [PermissionController::class, 'editPermissions'])->name('roles.permissions.edit');
    Route::put('/roles/{role}/permissions', [PermissionController::class, 'updatePermissions'])->name('roles.permissions.update');
    Route::resource('appointments', AppointmentController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('pets', PetController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('billing', BillingController::class);
    Route::post('/clients/store-from-billing', [ClientController::class, 'storeFromBilling'])->name('clients.store.from.billing');
});