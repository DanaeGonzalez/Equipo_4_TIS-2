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
        $customPermissions = [ //rutas más rebuscadas que no cumplen el estandar de map
            'Asignar Permisos' => 'roles.permissions.edit',
            'Actualizar Permisos del Rol' => 'roles.permissions.update',
            'Crear Clientes Factura' => 'clients.store.from.billing',
            'Guardar Inventario' => 'inventory.storeForProduct',
            'Cancelar Citas' => 'appointments.cancel',
            'Cancelar Cita' => 'appointments.cancel',
            'Reactivar Citas' => 'appointments.reactivate',
            'Reactivar Cita' => 'appointments.reactivate',
            'Actualizar Permisos' => 'roles.permissions.update',
        ];
        if (isset($customPermissions[$permissionName])) {
            return $customPermissions[$permissionName];
        }

        $map = [ //acciones
            'ver detalle de' => 'show',
            'ver' => 'index',
            'crear' => 'create',
            'generar' => 'create',
            'editar' => 'edit',
            'eliminar' => 'destroy',
            'asignar' => 'edit',
            'actualizar' => 'update',
            'guardar' => 'store',
            'descargar' => 'download',
            'Cancelar' => 'cancel',
            'Reactivar' => 'reactivate'
        ];

        $dictionary = [ //modelos
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
            'venta' =>'billing',
            'inventario' => 'inventory',
            'notas' => 'notes',
        ];

        $permissionName = strtolower($permissionName);

        foreach ($map as $action => $routeSuffix) {
            if (str_starts_with($permissionName, $action)) {
                $entity = trim(str_replace($action, '', $permissionName));
                $entity = Str::lower($entity);
                $entity = trim($entity);
                $entity = str_replace(['á','é','í','ó','ú','ñ'], ['a','e','i','o','u','n'], $entity);
                $entity = $dictionary[$entity] ?? $entity;
                if ($entity === 'billing' || $entity=== 'inventory'){ //es billing.action; no billings.action, inventory.action, no inventories(?)
                    return "$entity.$routeSuffix";
                }
                $entity = Str::plural($entity);
                return "$entity.$routeSuffix";
            }
        }
        return null;
    }
}
