<?php
/* Comenté todo, para usarlo más adelante
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /*public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado y es superadmin
        if (auth()->check() && auth()->user()->role_id == 1) {
            return $next($request);
        }

        // Si no es superadmin, redireccionar a dashboard normal
        return redirect('/')->with('error', 'Acceso no autorizado.');
    }
}*/