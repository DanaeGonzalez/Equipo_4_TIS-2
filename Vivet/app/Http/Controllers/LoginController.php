<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class LoginController extends Controller
{
	public function showLoginForm()
	{
		return view('auth.login');
	}

	public function loginUser(Request $request)
	{
		$request->validate([
			'email' => 'required',
			'password' => 'required',
		]);

		$throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

		if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
			$seconds = RateLimiter::availableIn($throttleKey);

			throw ValidationException::withMessages([
				'email' => ["Demasiados intentos. Por favor espera $seconds segundos e inténtalo nuevamente."],
			]);
		}

		RateLimiter::hit($throttleKey, 60);

		$credentials = $request->only('email', 'password');

		if (Auth::attempt($credentials)) {
			RateLimiter::clear($throttleKey);

			return redirect()->intended('/')
				->withSuccess('Sesión iniciada correctamente');
		}

		return back()->withErrors([
			'email' => 'Los datos introducidos no son correctos.',
		])->onlyInput('email');
	}
}
