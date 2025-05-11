<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminOrVet
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user || !in_array($user->role?->name, ['Administrador', 'Veterinario'])) {
            return redirect('/')->withErrors(['access' => 'No tienes permiso para acceder a esta sección.']);
        }

        return $next($request);
    }
}
