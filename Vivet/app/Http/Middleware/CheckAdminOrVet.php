<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminOrVet
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user || !in_array($user->role_id, [1, 3])) {
            return redirect('/')->withErrors(['access' => 'No tienes permiso para acceder a esta sección.']);
        }

        return $next($request);
    }
}
