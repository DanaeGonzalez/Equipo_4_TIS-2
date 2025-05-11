<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Models\Permission;

class SyncPermissionsFromRoutes extends Command
{
    protected $signature = 'permissions:sync';
    protected $description = 'Crea permisos automáticamente desde nombres y enlaza rutas';

    public function handle()
    {
        $this->info("Sincronizando permisos...");

        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            $routeName = $this->mapPermissionToRoute($permission->name);

            if ($routeName && Route::has($routeName)) {
                $permission->route_name = $routeName;
                $permission->save();

                $this->line("Permiso '{$permission->name}' asociado a ruta '{$routeName}'");
            } else {
                $this->warn("Permiso '{$permission->name}' no pudo mapearse a ninguna ruta válida.");
            }
        }

        $this->info("¡Sincronización completa!");
    }

    protected function mapPermissionToRoute(string $permissionName): ?string
    {
        $map = [
            'ver detalle de' => 'show',
            'ver' => 'index',
            'crear' => 'create',
            'editar' => 'edit',
            'eliminar' => 'destroy',
            'Ver' => 'index',
            'Crear' => 'create',
            'Editar' => 'edit',
            'Eliminar' => 'destroy',
            //'Agendar' => 'create',
        ];

        $dictionary = [
            'servicios' => 'services',
            'productos' => 'products',
            'usuarios' => 'users',
            'roles' => 'roles',
            'rol' => 'roles',
            'permisos' => 'permissions',
            'agenda' => 'appointments',
            'citas' => 'schedules'
        ];

        $permissionName = strtolower($permissionName);

        foreach ($map as $action => $routeSuffix) {
            if (str_starts_with($permissionName, $action)) {
                $entity = trim(str_replace($action, '', $permissionName));
                $entity = Str::plural(Str::lower($entity)); // "Producto" → "productos"
                $entity = $dictionary[$entity] ?? $entity; // Usa el nombre mapeado si existe
                return "$entity.$routeSuffix";             // → "products.index"
            }
        }

        return null;
    }
}
