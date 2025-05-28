<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $permissions = Permission::query();
        // Filtros
        if ($request->has('entity') && $request->entity) {
            $permissions->where('name', 'like', '%' . $request->entity . '%');
        }

        if ($request->has('action') && $request->action) {
            $permissions->where('name', 'like', $request->action . '%');
        }

        // Obtener todos los permisos filtrados
        $permissions = $permissions->get();

        // Agrupar permisos por entidad detectada (ej: usuario, boleta, etc.)
        $grouped = [];

        foreach ($permissions as $permission) {
            // Detectar entidad desde el nombre del permiso
            preg_match('/(?:ver|crear|editar|eliminar|actualizar|descargar|asignar|guardar|cancelar|generar) (.+)/i', strtolower($permission->name), $matches);
            $entity = $matches[1] ?? 'otros';
            $entity = ucfirst(trim($entity));

            $grouped[$entity][] = $permission;
        }

        // Lista de entidades únicas (para filtro)
        $entities = array_keys($grouped);

        // Acciones base (para filtro)
        $actions = ['ver', 'crear', 'editar', 'eliminar', 'actualizar', 'asignar', 'guardar', 'descargar', 'cancelar', 'generar'];

        return view('permissions.index', [
            'groupedPermissions' => $grouped,
            'entities' => $entities,
            'actions' => $actions
        ]);
        /*if ($request->has('group') && $request->group !== '') {
            $permissions->where('group', $request->group); // o el campo que uses para agrupar
        }

        $permissions = $permissions->orderBy('group')->orderBy('name')->paginate(10);

        $grouped = $permissions->getCollection()->groupBy('group');

        return view('permissions.index', [
            'permissions' => $permissions,
            'grouped' => $grouped,
            'groups' => Permission::select('group')->distinct()->pluck('group') // para el filtro
        ]);*/
    }

    public function create()
    {
        return view('permissions.create');
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

        return redirect()->route('permissions.index')->with('success', 'Permiso creado.');
    }

    public function editPermissions(Role $role)
    {
        $permissions = Permission::all();

        // Agrupar por entidad (similar al index)
        $grouped = [];

        foreach ($permissions as $permission) {
            preg_match('/(?:ver|crear|editar|eliminar|actualizar|descargar|asignar|guardar|cancelar|generar) (.+)/i', strtolower($permission->name), $matches);
            $entity = $matches[1] ?? 'Otros';
            $entity = ucfirst(trim($entity));
            $grouped[$entity][] = $permission;
        }

        ksort($grouped); // Ordena alfabéticamente por grupo

        return view('roles.edit-permissions', compact('role', 'grouped'));
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $role->permissions()->sync($request->permissions);
        return redirect()->route('roles.index')->with('success', 'Permisos actualizados.');
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        //$permission->update($request->permissions);
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            'description' => 'required|string|max:255',

        ]);

        $permission->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permiso actualizado.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permiso eliminado.');
    }
}
