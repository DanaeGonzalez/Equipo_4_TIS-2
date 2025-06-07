<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use App\Models\User;

class ForgotPasswordController extends Controller
{

    public function showLinkRequestForm()
    {
        return view('tenant.auth.password');
    }
    
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No encontramos un usuario con ese correo.']);
        }

        $token = Str::random(64);
        $user->password_token = $token;
        $user->token_created_at = now();
        $user->save();

        Mail::to($user->email)->send(new ResetPasswordMail($user));

        return back()->with('status', 'Hemos enviado el enlace de recuperación a tu correo.');
    }
}
