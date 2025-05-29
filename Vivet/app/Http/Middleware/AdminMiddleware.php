<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role?->name === 'Administrador') {
            return $next($request);
        } 
        if (auth()->user() && !auth()->user()->is_active) {
            abort(403, 'Usuario desactivado.');
        }
        return  redirect('/')->with('error', 'Acceso no autorizado');
    }
}
