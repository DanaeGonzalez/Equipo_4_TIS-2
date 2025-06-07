<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{

    public function showResetForm($token)
    {
        return view('tenant.auth.reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('password_token', $request->token)->first();

        if (!$user || Carbon::parse($user->token_created_at)->addHour()->isPast()) {
            return back()->withErrors(['token' => 'El enlace ha expirado o no es válido.']);
        }

        $user->password = Hash::make($request->password);
        $user->password_token = null;
        $user->token_created_at = null;
        $user->save();

        return redirect()->route('login')->with('status', 'Contraseña actualizada correctamente.');
    }
}
