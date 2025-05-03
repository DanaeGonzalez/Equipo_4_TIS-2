<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function loginUser(Request $request)
	{
	    // Comprobamos que el email y la contraseña han sido introducidos
	    $request->validate([
	        'email' or 'run' => 'required',
	        'password' => 'required',
	    ]);
	
	    // Almacenamos las credenciales de email y contraseña
	    $credentials = $request->only('email', 'password');
	
	    // Si el usuario existe lo logamos y lo llevamos a la página principal con un mensaje
	    if (Auth::attempt($credentials)) {
	        return redirect()->intended('/')
	            ->withSuccess('Sesión iniciada correctamente');
	    }
	
	    // Si el usuario no existe devolvemos al usuario al formulario de login con un mensaje de error
	    return redirect()->route('login')->withSuccess('Los datos introducidos no son correctos');
	}
}
