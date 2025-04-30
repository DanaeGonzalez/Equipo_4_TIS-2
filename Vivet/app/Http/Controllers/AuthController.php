<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm(){
        return view('auth.register');
    }
    public function registerUser(Request $request){
    
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last-name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email', 'max:250'],
            'password' => ['required', "min:8", 'confirmed']
        ]);
    
        User::create([
            'name' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password)
            ]);
            
            $credentials = $request->only('email', 'password');
            Auth::attempt($credentials);
            $request->session()->regenerate();
            
            // Redirigir al formulario de login
            return redirect()->route('/');
    }
    public function index(){
	    // Comprobamos si el usuario ya está logado
	    if (Auth::check()) {
	        // Si está logado le mostramos la vista de logados
	        return view('logados');
	    }
	    // Si no está logado le mostramos la vista con el formulario de login
	    return view('login');
	}

    /**
	* Función que se encarga de recibir los datos del formulario de login, comprobar que el usuario existe y
	* en caso correcto logar al usuario
	*/
	public function login(Request $request)
	{
	    // Comprobamos que el email y la contraseña han sido introducidos
	    $request->validate([
	        'email' => 'required',
	        'password' => 'required',
	    ]);
	
	    // Almacenamos las credenciales de email y contraseña
	    $credentials = $request->only('email', 'password');
	
	    // Si el usuario existe lo logamos y lo llevamos a la vista de "logados" con un mensaje
	    if (Auth::attempt($credentials)) {
	        return redirect()->intended('logados')
	            ->withSuccess('Logado Correctamente');
	    }
	
	    // Si el usuario no existe devolvemos al usuario al formulario de login con un mensaje de error
	    return redirect("/")->withSuccess('Los datos introducidos no son correctos');
	}
	
	/**
	* Función que muestra la vista de logados si el usuario está logado y si no le devuelve al formulario de login
	* con un mensaje de error
	*/
	public function logados()
	{
	    if (Auth::check()) {
	        return view('logados');
	    }
	
	    return redirect("/")->withSuccess('No tienes acceso, por favor inicia sesión');
    }
}


