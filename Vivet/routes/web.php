<?php

use Illuminate\Support\Facades\Route;

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

