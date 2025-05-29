<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('tenant.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('tenant.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        Permission::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        Artisan::call('permissions:sync');

        return redirect()->route('tenant.permissions.index')->with('success', 'Permiso creado.');
    }

    public function editPermissions(Role $role) 
    {
        $permissions = Permission::all();
        return view('tenant.roles.edit-permissions', compact('role', 'permissions'));
    }

    public function updatePermissions(Request $request, Role $role) 
    {
        $role->permissions()->sync($request->permissions);
        return redirect()->route('tenant.roles.index')->with('success', 'Permisos actualizados.');
    }

    public function edit(Permission $permission)
    {
        return view('tenant.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            'description' => 'required|string|max:255',

        ]);

        $permission->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('tenant.permissions.index')->with('success', 'Permiso actualizado.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('tenant.permissions.index')->with('success', 'Permiso eliminado.');
    }
}
