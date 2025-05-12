<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Productos
            
                ['name' => 'Ver Productos', 'route_name' => 'products.index'],
                ['name' => 'Crear Producto', 'route_name' => 'products.create'],
                ['name' => 'Guardar Producto', 'route_name' => 'products.store'],
                ['name' => 'Editar Producto', 'route_name' => 'products.edit'],
                ['name' => 'Actualizar Producto', 'route_name' => 'products.update'],
                ['name' => 'Eliminar Producto', 'route_name' => 'products.destroy'],
            

            // Servicios
        
                ['name' => 'Ver Servicios', 'route_name' => 'services.index'],
                ['name' => 'Crear Servicios', 'route_name' => 'services.create'],
                ['name' => 'Guardar Servicios', 'route_name' => 'services.store'],
                ['name' => 'Editar Servicios', 'route_name' => 'services.edit'],
                ['name' => 'Eliminar Servicios', 'route_name' => 'services.destroy'],
                ['name' => 'Actualizar Servicios', 'route_name' => 'services.update'],
            
            // Roles
        
                ['name' => 'Ver Roles', 'route_name' => 'roles.index'],
                ['name' => 'Crear Roles', 'route_name' => 'roles.create'],
                ['name' => 'Guardar Roles', 'route_name' => 'roles.store'],
                ['name' => 'Editar Roles', 'route_name' => 'roles.edit'],
                ['name' => 'Eliminar Roles', 'route_name' => 'roles.destroy'],
                ['name' => 'Actualizar Roles', 'route_name' => 'roles.update'],
            
            // Usuarios
        
                ['name' => 'Ver Usuarios', 'route_name' => 'users.index'],
                ['name' => 'Crear Usuarios', 'route_name' => 'users.create'],
                ['name' => 'Guardar Usuarios', 'route_name' => 'users.store'],
                ['name' => 'Editar Usuarios', 'route_name' => 'users.edit'],
                ['name' => 'Eliminar Usuarios', 'route_name' => 'users.destroy'],
                ['name' => 'Actualizar Usuarios', 'route_name' => 'users.update'],
            
            // Permisos
            ['name' => 'Ver Permisos', 'route_name' => 'permissions.index'],
            ['name' => 'Guardar Permisos', 'route_name' => 'permissions.store'],
            ['name' => 'Asignar Permisos', 'route_name' => 'roles.permissions.edit'],
            ['name' => 'Actualizar Permisos', 'route_name' => 'roles.permissions.update'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate([
                'name' => $perm['name'],
                'route_name' => $perm['route_name'] ?? null,
            ]);
        }
    }
}
