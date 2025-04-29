<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        dd([
            'url_actual' => $request->path(),
            'guard_activo' => auth()->getDefaultDriver(),
        ]);

        if (! $request->expectsJson()) {
            return '/login';
        }
    }
}
