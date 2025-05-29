<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use app\Models\User;

class CheckPermissionByRoute
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user || !$user->role || $user->role->permissions->isEmpty()) {
            //abort(403, 'No autorizado');
            return  redirect('/')->with('error', 'Acceso no autorizado');
        }

        $currentRoute = $request->route()->getName();
        if (!$currentRoute) {
            //abort(403, 'Ruta sin nombre: no se puede verificar permiso.');
            return  redirect('/')->with('error', 'Acceso no autorizado');
        }

        $hasPermission = $user->role->permissions->contains('route_name', $currentRoute);

        if (!$hasPermission) {
            //abort(403, 'No tienes permiso para acceder a esta ruta');
            return  redirect('/')->with('error', 'Acceso no autorizado');
        }

        return $next($request);
    }
}
