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
        /*$this->info("Sincronizando permisos...");

         $customPermissions = [
            'Asignar Permisos' => 'roles.permissions.edit',
            'Actualizar Permisos' => 'roles.permissions.update'
        ];

        foreach ($customPermissions as $name => $route) {
            $permission = Permission::updateOrCreate(
                ['route_name' => $route],
                ['name' => $name]
            );

            $this->info("Permiso '{$name}' asociado a ruta '{$route}'");
        }*/

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
        $customPermissions = [
            'Asignar Permisos' => 'roles.permissions.edit',
            'Actualizar Permisos' => 'roles.permissions.update'
        ];
        if (isset($customPermissions[$permissionName])) {
            return $customPermissions[$permissionName];
        }

        $map = [
            'ver detalle de' => 'show',
            'ver' => 'index',
            'crear' => 'create',
            'editar' => 'edit',
            'eliminar' => 'destroy',
            'asignar' => 'edit',
            'actualizar' => 'update',
            'guardar' => 'store'
        ];

        $dictionary = [
            'servicio' => 'services',
            'servicios' => 'services',
            'producto' => 'products',
            'productos' => 'products',
            'usuario' => 'users',
            'usuarios' => 'users',
            'rol' => 'roles',
            'roles' => 'roles',
            'permiso' => 'permissions',
            'permisos' => 'permissions',
            'agenda' => 'appointments',
            'agendas' => 'appointments',
            'cita' => 'schedules',
            'citas' => 'schedules',
            'mascota'=>'pets',
            'mascotas'=>'pets',
            'cliente' =>'client',
            'clientes' =>'client',
            'boleta' => 'billing',
            'boletas' => 'billing',
            'venta' =>'billing'
        ];

        $permissionName = strtolower($permissionName);

        foreach ($map as $action => $routeSuffix) {
            if (str_starts_with($permissionName, $action)) {
                $entity = trim(str_replace($action, '', $permissionName));
                $entity = Str::lower($entity);
                $entity = $dictionary[$entity] ?? $entity;
                $entity = Str::plural($entity);
                return "$entity.$routeSuffix";
            }
        }
        return null;
    }
}
