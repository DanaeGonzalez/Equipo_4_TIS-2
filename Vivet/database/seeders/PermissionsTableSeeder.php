<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Aquí se deben ir colocando los permisos predeterminados que se desea que tengan todos los clientes
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
            ['name' => 'Crear Permisos', 'route_name' => 'permissions.create'],
            ['name' => 'Guardar Permisos', 'route_name' => 'permissions.store'],
            ['name' => 'Asignar Permisos', 'route_name' => 'roles.permissions.edit'],
            ['name' => 'Editar Permisos', 'route_name' => 'permissions.edit'],
            ['name' => 'Actualizar Permisos', 'route_name' => 'permissions.update'],
            ['name' => 'Actualizar Permisos del Rol', 'route_name' => 'roles.permissions.update'],

            // Schedules
            ['name' => 'Ver Citas', 'route_name' => 'schedules.index'],
            ['name' => 'Crear Citas', 'route_name' => 'schedules.create'],
            ['name' => 'Guardar Citas', 'route_name' => 'schedules.store'],
            ['name' => 'Asignar Citas', 'route_name' => 'schedules.edit'],
            ['name' => 'Actualizar Citas', 'route_name' => 'schedules.update'],
            ['name' => 'Cancelar Citas', 'route_name' => 'appointments.cancel'],
            ['name' => 'Reactivar Citas', 'route_name' => 'appointments.reactivate'],

            // Appointments
            ['name' => 'Ver Agenda', 'route_name' => 'appointments.index'],
            ['name' => 'Crear Agenda', 'route_name' => 'appointments.create'],
            ['name' => 'Guardar Agenda', 'route_name' => 'appointments.store'],
            ['name' => 'Asignar Agenda', 'route_name' => 'appointments.edit'],
            ['name' => 'Eliminar Agenda', 'route_name' => 'appointments.destroy'],
            ['name' => 'Actualizar Agenda', 'route_name' => 'appointments.update'],
            ['name' => 'Cancelar Agenda', 'route_name' => 'appointments.cancel'],
            ['name' => 'Reactivar Agenda', 'route_name' => 'appointments.reactivate'],

            // Notas
            ['name' => 'Ver Notas', 'route_name' => 'notes.index'],
            ['name' => 'Crear Notas', 'route_name' => 'notes.create'],
            ['name' => 'Guardar Notas', 'route_name' => 'notes.store'],
            ['name' => 'Editar Notas', 'route_name' => 'notes.edit'],
            ['name' => 'Actualizar Notas', 'route_name' => 'notes.update'],
            ['name' => 'Eliminar Notas', 'route_name' => 'notes.destroy'],

            //Billings
            ['name' => 'Ver Boleta', 'route_name' => 'billing.index'],
            ['name' => 'Ver detalle de Boleta', 'route_name' => 'billing.index'],
            ['name' => 'Crear Boleta', 'route_name' => 'billing.create'],
            ['name' => 'Guardar Boleta', 'route_name' => 'billing.store'],
            ['name' => 'Editar Boleta', 'route_name' => 'billing.edit'],
            ['name' => 'Actualizar Boleta', 'route_name' => 'billing.update'],
            ['name' => 'Eliminar Boleta', 'route_name' => 'billing.destroy'],
            ['name' => 'Descargar Boleta', 'route_name' => 'billing.download'],

            // Clientes
            ['name' => 'Ver Clientes', 'route_name' => 'clients.index'],
            ['name' => 'Crear Cliente', 'route_name' => 'clients.create'],
            ['name' => 'Guardar Cliente', 'route_name' => 'clients.store'],
            ['name' => 'Editar Cliente', 'route_name' => 'clients.edit'],
            ['name' => 'Actualizar Cliente', 'route_name' => 'clients.update'],
            ['name' => 'Eliminar Cliente', 'route_name' => 'clients.destroy'],
            ['name' => 'Guardar Cliente desde Boleta', 'route_name' => 'clients.store.from.billing'],

            // Mascotas (Pets)
            ['name' => 'Ver Mascotas', 'route_name' => 'pets.index'],
            ['name' => 'Crear Mascota', 'route_name' => 'pets.create'],
            ['name' => 'Guardar Mascota', 'route_name' => 'pets.store'],
            ['name' => 'Editar Mascota', 'route_name' => 'pets.edit'],
            ['name' => 'Actualizar Mascota', 'route_name' => 'pets.update'],
            ['name' => 'Eliminar Mascota', 'route_name' => 'pets.destroy'],

            // Historia Clínica
            ['name' => 'Ver Historias Clínicas', 'route_name' => 'clinical_records.index'],
            ['name' => 'Crear Historia Clínica', 'route_name' => 'clinical_records.create'],
            ['name' => 'Guardar Historia Clínica', 'route_name' => 'clinical_records.store'],
            ['name' => 'Editar Historia Clínica', 'route_name' => 'clinical_records.edit'],
            ['name' => 'Actualizar Historia Clínica', 'route_name' => 'clinical_records.update'],
            ['name' => 'Eliminar Historia Clínica', 'route_name' => 'clinical_records.destroy'],

            // Recetas (Prescriptions)
            ['name' => 'Crear Receta', 'route_name' => 'prescriptions.create'],
            ['name' => 'Guardar Receta', 'route_name' => 'prescriptions.store'],
            ['name' => 'Editar Receta', 'route_name' => 'prescriptions.edit'],
            ['name' => 'Actualizar Receta', 'route_name' => 'prescriptions.update'],
            ['name' => 'Eliminar Receta', 'route_name' => 'prescriptions.destroy'],

            // Medicamentos
            ['name' => 'Ver Medicamentos', 'route_name' => 'medications.index'],
            ['name' => 'Crear Medicamento', 'route_name' => 'medications.create'],
            ['name' => 'Guardar Medicamento', 'route_name' => 'medications.store'],
            ['name' => 'Editar Medicamento', 'route_name' => 'medications.edit'],
            ['name' => 'Actualizar Medicamento', 'route_name' => 'medications.update'],
            ['name' => 'Eliminar Medicamento', 'route_name' => 'medications.destroy'],

            // Inventario
            ['name' => 'Ver Inventario', 'route_name' => 'inventory.index'],
            ['name' => 'Crear Inventario', 'route_name' => 'inventory.create'],
            ['name' => 'Guardar Inventario', 'route_name' => 'inventory.store'],
            ['name' => 'Editar Inventario', 'route_name' => 'inventory.edit'],
            ['name' => 'Actualizar Inventario', 'route_name' => 'inventory.update'],
            ['name' => 'Eliminar Inventario', 'route_name' => 'inventory.destroy'],
            ['name' => 'Guardar Inventario para Producto', 'route_name' => 'inventory.storeForProduct'],

            // Insumos (Supplies)
            ['name' => 'Ver Insumos', 'route_name' => 'supplies.index'],
            ['name' => 'Crear Insumo', 'route_name' => 'supplies.create'],
            ['name' => 'Guardar Insumo', 'route_name' => 'supplies.store'],
            ['name' => 'Editar Insumo', 'route_name' => 'supplies.edit'],
            ['name' => 'Actualizar Insumo', 'route_name' => 'supplies.update'],
            ['name' => 'Eliminar Insumo', 'route_name' => 'supplies.destroy'],
            ['name' => 'Ajustar Stock de Insumo', 'route_name' => 'supplies.adjustStock'],
            ['name' => 'Ver Movimientos de Insumo', 'route_name' => 'supplies.movements'],
            ['name' => 'Formulario de Ajuste de Insumo', 'route_name' => 'supplies.adjustStockForm'],

            // Exámenes
            ['name' => 'Ver Exámenes', 'route_name' => 'exams.index'],
            ['name' => 'Enviar Exámenes', 'route_name' => 'exams.send'],
            ['name' => 'Ver Historial de Exámenes', 'route_name' => 'exams.history'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate([
                'name' => $perm['name'],
                'route_name' => $perm['route_name'] ?? null,
            ]);
        }
    }
}
