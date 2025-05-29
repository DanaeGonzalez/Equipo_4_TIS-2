<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockTenancyOnCentralDomains
{
    public function handle(Request $request, Closure $next)
    {
        $centralDomains = [
            'vetcodex.test',
            'localhost',
            '127.0.0.1',
        ];

        if (in_array($request->getHost(), $centralDomains)) {
            if (tenancy()->initialized) {
                tenancy()->end();
            }
        }

        return $next($request);
    }
}
