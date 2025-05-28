<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm(){
        return view('auth.register');
    }
    public function registerUser(Request $request){
    
        $validatedData = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'run' => ['required', 'string', 'min:7','max:8'],
            'email' => ['required', 'email', 'unique:users,email', 'max:250'],
            'password' => ['required', "min:8", "max:15", 'confirmed']
        ]);

        $role = Role::where('name', 'Tutor')->first();
        User::create([
            'role_id' => $role->id,
            'name' => $request->nombre,
            'lastname' => $request->apellido,
            'run' => $request->run,
            'email' => $request->email,
            'password' => Hash::make($request->password)
            ]);
            
            $credentials = $request->only('email', 'password');
            Auth::attempt($credentials);
            $request->session()->regenerate();
            
            // Redirigir al formulario de login
            return redirect()->route('login')->with('success','Registro exitoso! Por favor inicie sesión.');
    }
}