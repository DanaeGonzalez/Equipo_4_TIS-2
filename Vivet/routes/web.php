<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

