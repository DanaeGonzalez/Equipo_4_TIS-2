<?php

namespace App\Http\Middleware;

use Closure;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Tenancy;

class CustomTenancyMiddleware extends InitializeTenancyByDomain
{
    public function handle($request, Closure $next)
    {
        $centralDomains = [
            'vetcodex.test',
            'localhost',
            '127.0.0.1',
        ];

        if (in_array($request->getHost(), $centralDomains)) {
            return $next($request); // 👈 NO activa tenancy
        }

        return parent::handle($request, $next); // 👈 activa tenancy solo si no es dominio central
    }
}
