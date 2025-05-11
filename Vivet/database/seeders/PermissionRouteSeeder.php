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
            'Crear Productos' => 'products.create',
            'Editar Productos' => 'products.edit',
            'Eliminar Productos' => 'products.destroy',

            'Ver Servicios' => 'services.index',
            'Crear Servicios' => 'services.create',
            'Editar Servicios' => 'services.edit',
            'Eliminar Servicios' => 'services.destroy',

            'Ver Citas' => 'schedules.index',
            'Crear Citas' => 'schedules.create',
            'Editar Citas' => 'schedules.edit',
            'Eliminar Citas' => 'schedules.destroy',

        ];

        foreach ($map as $permissionName => $routeName) {
            Permission::where('name', $permissionName)->update(['route_name' => $routeName]);
        }

        $this->command->info('Rutas actualizadas en la tabla de permisos.');
    }
}

