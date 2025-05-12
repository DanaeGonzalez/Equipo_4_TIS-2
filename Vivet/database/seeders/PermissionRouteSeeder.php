<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionRouteSeeder extends Seeder
{
    public function run()
    {
        $map = [
            'Ver Productos' => 'products.index',
            'Crear Producto' => 'products.create',
            'Guardar Producto' => 'products.store',
            'Editar Producto' => 'products.edit',
            'Eliminar Producto' => 'products.destroy',
            'Actualizar Producto' => 'products.update',

            'Ver Servicios' => 'services.index',
            'Crear Servicios' => 'services.create',
            'Guardar Servicios' => 'services.store',
            'Editar Servicios' => 'services.edit',
            'Eliminar Servicios' => 'services.destroy',
            'Actualizar Servicios' => 'services.update',

            'Ver Citas' => 'schedules.index',
            'Crear Citas' => 'schedules.create',
            'Guardar Citas' => 'schedules.store',
            'Editar Citas' => 'schedules.edit',
            'Eliminar Citas' => 'schedules.destroy',
            'Actualizar Citas' => 'schedules.update',
            
            'Ver Agenda' => 'appointments.index',
            'Crear Agenda' => 'appointments.create',
            'Guardar Agenda' => 'appointments.store',
            'Editar Agenda' => 'appointments.edit',
            'Eliminar Agenda' => 'appointments.destroy',
            'Actualizar Agenda' => 'appointments.update',
        ];

        foreach ($map as $permissionName => $routeName) {
            Permission::where('name', $permissionName)->update(['route_name' => $routeName]);
        }

        $this->command->info('Rutas actualizadas en la tabla de permisos.');
    }
}

