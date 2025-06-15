<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('tenant.dashboard.modules.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('tenant.dashboard.modules.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Role::create([
            'name' => $request->name,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('roles.index')->with('success', 'Rol creado.');
    }

    public function edit(Role $role)
    {
        return view('tenant.dashboard.modules.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $role->update([
            'name' => $request->name,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado.');
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'Administrador') {
            return redirect()->route('roles.index')->with('error', 'No se puede eliminar este rol.');
        }

        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado.');
    }
}
