<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ExamController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', fn () => view('central.landing'));
        Route::get('/check', fn () => 'CENTRAL');
    });
}

Route::get('/csrf-test', function () {
    session(['test_csrf' => 'funciona']);
    return view('central.csrf-test');
});

Route::post('/csrf-test', function () {
    return '¡CSRF y sesión funcionando!';
})->name('csrf.test');

Route::get('/test-login-form', function () {
    return '
        <form method="POST" action="/admin/login">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <input name="email" type="email" value="admin@vetcodex.cl">
            <input name="password" type="password">
            <button type="submit">Login</button>
        </form>
    ';
});

Route::get('/test-user', function () {
    return Auth::check() ? Auth::user()->email : 'No autenticado';
});

Route::get('/prueba-tenant', function () {
    tenancy()->initialize('vivet');
    return DB::connection()->getDatabaseName();
});

Route::get('/prueba-db', function () {
    $tenant = Tenant::find('vivet');
    tenancy()->initialize($tenant);
    return 'BD activa: ' . DB::connection()->getDatabaseName();
});




/*COMPROBACION TEMPORAL
foreach (['vetcodex.test', 'localhost', '127.0.0.1'] as $centralDomain) {
    Route::domain($centralDomain)->group(function () {
        Route::get('/', fn () => view('central.landing'));
        Route::get('/check', fn () => 'CENTRAL');
    });
}*/

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {
//     return view('landing');
// });

// Route::middleware(['auth', 'is_active'])->group(function () {});

// Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy-policy');

// Route::view('/terms-of-service', 'pages.terms-of-service')->name('terms-of-service');

// Route::view('/contact', 'pages.contact')->name('contact');

// Route::view('/about-us', 'pages.about-us')->name('about');

// Route::view('/faq', 'pages.faq')->name('faq');

// Route::get('/register-form', [RegisterController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'registerUser'])->name('register.submit');

// Route::get('/login-form', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'loginUser'])->name('login.submit');
// Route::post('/logout', [LogoutController::class, 'destroy'])->middleware('auth')->name('logout');


// Route::middleware(['check.permission'])->group(function () {
//     Route::resource('products', ProductController::class);
//     Route::resource('services', ServiceController::class);
//     Route::resource('roles', RoleController::class);
//     Route::resource('users', UserController::class);
//     Route::resource('permissions', PermissionController::class);
//     Route::get('/roles/{role}/permissions/edit', [PermissionController::class, 'editPermissions'])->name('roles.permissions.edit');
//     Route::put('/roles/{role}/permissions', [PermissionController::class, 'updatePermissions'])->name('roles.permissions.update');
//     Route::resource('appointments', AppointmentController::class);
//     Route::resource('schedules', ScheduleController::class);
//     Route::resource('pets', PetController::class);
//     Route::resource('clients', ClientController::class);
//     Route::resource('billing', BillingController::class);
//     Route::get('/exams', [ExamController::class, 'showExams'])->name('exams.index');
//     Route::post('/exams/send', [ExamController::class, 'send'])->name('exams.send');
//     Route::get('/exams/history/{user}', [ExamController::class, 'history'])->name('exams.history');
// });
