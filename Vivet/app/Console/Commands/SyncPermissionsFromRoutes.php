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
        $customPermissions = [ // rutas más rebuscadas o con nombres inconsistentes
            'Enviar Examenes' => 'exams.send',
            'Ver Historial de Examenes' => 'exams.history',
            'Asignar Permisos' => 'roles.permissions.edit',
            'Actualizar Permisos del Rol' => 'roles.permissions.update',
            'Actualizar Permisos' => 'roles.permissions.update',
            'Cancelar Citas' => 'appointments.cancel',
            'Cancelar Cita' => 'appointments.cancel',
            'Reactivar Citas' => 'appointments.reactivate',
            'Reactivar Cita' => 'appointments.reactivate',
            'Crear Clientes Factura' => 'clients.store.from.billing',
            'Guardar Inventario' => 'inventory.storeForProduct',
            'Guardar Cliente desde Boleta' => 'clients.store.from.billing',
            'Guardar Proveedor desde Productos' => 'suppliers.store.from.product',
            'Guardar Proveedor desde Insumos' => 'suppliers.store.from.supply',

            // Historias clínicas
            'Ver Historias Clínicas' => 'clinical_records.index',
            'Crear Historia Clínica' => 'clinical_records.create',
            'Guardar Historia Clínica' => 'clinical_records.store',
            'Editar Historia Clínica' => 'clinical_records.edit',
            'Actualizar Historia Clínica' => 'clinical_records.update',
            'Eliminar Historia Clínica' => 'clinical_records.destroy',
            // Otros posibles
            'Ajustar Stock de Insumo' => 'supplies.adjustStock',
            'Ver Movimientos de Insumo' => 'supplies.movements',
            'Formulario de Ajuste de Insumo' => 'supplies.adjustStockForm',
            'Ajustar Stock de Producto' => 'products.adjustStock',
            'Ver Movimientos de Producto' => 'products.movements',
            'Formulario de Ajuste de Producto' => 'products.adjustStockForm',
            'Guardar Inventario para Producto' => 'inventory.storeForProduct',
            'Ver Gastos' => 'purchase-details.index',
        ];
        if (isset($customPermissions[$permissionName])) {
            return $customPermissions[$permissionName];
        }

        $map = [ //acciones
            'ver detalle de' => 'show',
            'ver' => 'index',
            'crear' => 'create',
            'registrar' => 'create',
            'editar' => 'edit',
            'eliminar' => 'destroy',
            'asignar' => 'edit',
            'actualizar' => 'update',
            'guardar' => 'store',
            'descargar' => 'download',
            'cancelar' => 'cancel',
            'reactivar' => 'reactivate'
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
            'mascota' => 'pets',
            'mascotas' => 'pets',
            'cliente' => 'client',
            'clientes' => 'client',
            'boleta' => 'billing',
            'boletas' => 'billing',
            'venta' => 'billing',
            'examenes' => 'exams',
            'examen' => 'exams',
            'nota' => 'notes',
            'notas' => 'notes',
            'inventario' => 'inventory',
            'medicamento' => 'medications',
            'medicamentos' => 'medications',
            'insumo' => 'supplies',
            'insumos' => 'supplies',
            'receta' => 'prescriptions',
            'recetas' => 'prescriptions',
            'proveedor' => 'suppliers',
            'proveedores' => 'suppliers',
        ];

        $permissionName = strtolower($permissionName);

        foreach ($map as $action => $routeSuffix) {
            if (str_starts_with($permissionName, $action)) {
                $entity = trim(str_replace($action, '', $permissionName));
                $entity = Str::lower($entity);
                $entity = trim($entity);
                $entity = str_replace(['á', 'é', 'í', 'ó', 'ú', 'ñ'], ['a', 'e', 'i', 'o', 'u', 'n'], $entity);
                $entity = $dictionary[$entity] ?? $entity;
                if ($entity === 'billing' || $entity === 'inventory') { //es billing.action; no billings.action, inventory.action, no inventories(?)
                    return "$entity.$routeSuffix";
                }
                $entity = Str::plural($entity);
                return "$entity.$routeSuffix";
            }
        }
        return null;
    }
}
