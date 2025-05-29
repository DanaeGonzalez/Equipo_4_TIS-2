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
use App\Http\Controllers\NoteController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Estas rutas son cargadas por el TenantRouteServiceProvider automáticamente
| y ya tienen tenancy activado (InitializeTenancyByDomain).
|
*/

Route::get('/check', fn() => 'TENANT: ' . tenant('id'));

Route::get('/', function () {
    return view('tenant.landing');
});

Route::middleware(['auth', 'is_active'])->group(function () {
    //
});

Route::view('/privacy-policy', 'tenant.pages.privacy-policy')->name('privacy-policy');

Route::view('/terms-of-service', 'tenant.pages.terms-of-service')->name('terms-of-service');

Route::view('/contact', 'tenant.pages.contact')->name('contact');

Route::view('/blog', 'tenant.blog.index')->name('blog');

Route::view('/about-us', 'tenant.pages.about-us')->name('about');

Route::view('/faq', 'tenant.pages.faq')->name('faq');

Route::get('/register-form', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'registerUser'])->name('register.submit');

Route::get('/login-form', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'loginUser'])->name('login.submit');
Route::post('/logout', [LogoutController::class, 'destroy'])->middleware('auth')->name('logout');

//Route::middleware(['check.permission'])->group(function () {});

Route::resource('products', ProductController::class);
Route::resource('services', ServiceController::class);
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('permissions', PermissionController::class);
Route::get('/roles/{role}/permissions/edit', [PermissionController::class, 'editPermissions'])->name('roles.permissions.edit');
Route::put('/roles/{role}/permissions', [PermissionController::class, 'updatePermissions'])->name('roles.permissions.update');
Route::resource('appointments', AppointmentController::class);
Route::resource('schedules', ScheduleController::class);
Route::resource('pets', PetController::class);
Route::resource('clients', ClientController::class);
Route::resource('billing', BillingController::class);
Route::get('/exams', [ExamController::class, 'showExams'])->name('exams.index');
Route::post('/exams/send', [ExamController::class, 'send'])->name('exams.send');
Route::get('/exams/history/{user}', [ExamController::class, 'history'])->name('exams.history');
Route::post('/clients/store-from-billing', [ClientController::class, 'storeFromBilling'])->name('clients.store.from.billing');


//                        Rutas appointments

Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('tenant.appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
Route::post('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
Route::post('/appointments/{appointment}/reactivate', [AppointmentController::class, 'reactivate'])->name('appointments.reactivate');


// Rutas schedules

Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy'])->name(name: 'schedules.destroy');
Route::get('/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
Route::put('/schedules/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
Route::get('/generate-schedules', [ScheduleController::class, 'generateSchedules'])->name('schedules.generate');

// Rutas Notes

Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
