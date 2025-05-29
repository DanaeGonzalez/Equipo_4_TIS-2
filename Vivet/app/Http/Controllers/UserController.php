<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('tenant.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('tenant.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'run' => 'required|string|unique:users',
            'sex' => 'required|in:Hombre,Mujer,Otro',
            'email' => 'required|email|unique:users',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'role_id' => $request->role_id,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'run' => $request->run,
            'sex' => $request->sex,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'run' => ['required', 'string', Rule::unique('users')->ignore($user->id)],
            'sex' => 'required|in:Hombre,Mujer,Otro',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $updateData = [
            'role_id' => $request->role_id,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'run' => $request->run,
            'sex' => $request->sex,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ];

        // Si el usuario no está editando su propio perfil
        if (auth()->id() != $user->id) {
            $updateData['is_active'] = $request->is_active ? 1 : 0;
        }

        // Actualizamos los datos del usuario
        $user->update($updateData);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        // Evita que un usuario se desactive a sí mismo
        if (auth()->id() == $user->id) {
            return redirect()->route('users.index')->with('error', 'No puedes desactivarte a ti mismo.');
        }
        $user->update(['is_active' => false]);

        return redirect()->route('users.index')->with('success', 'Usuario desactivado correctamente.');
    }
}
