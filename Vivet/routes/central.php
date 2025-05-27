<?php

use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', fn () => view('central.landing'));
        Route::get('/check', fn () => 'CENTRAL');
    });
}
