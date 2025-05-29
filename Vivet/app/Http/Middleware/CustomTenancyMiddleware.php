<?php

namespace App\Http\Middleware;

use Closure;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Tenancy;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CustomTenancyMiddleware extends InitializeTenancyByDomain
{
    public function handle($request, Closure $next)
    {
        $centralDomains = [
            config('tenancy.central_domains')[0] ?? 'vetcodex.test', // Dominio actual
            'localhost',
            '127.0.0.1',
        ];

        if (in_array($request->getHost(), $centralDomains)) {
            return $next($request); // NO activa tenancy
        }

        //return parent::handle($request, $next); // activa tenancy solo si no es dominio central
        try {
            return parent::handle($request, $next); // activa tenancy solo si no es dominio central
        } catch (\Stancl\Tenancy\Exceptions\TenantCouldNotBeIdentifiedOnDomainException $e) {
            // Si no hay un tenant asociado al dominio, lanzar 404
            throw new NotFoundHttpException();
        }
    }
}
