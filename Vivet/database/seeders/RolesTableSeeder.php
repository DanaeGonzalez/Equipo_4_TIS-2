<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder 

{
    public function run(): void
    {
        // Verificamos si la tabla roles está vacía
        if (DB::table('roles')->count() == 0) {
            // Si está vacía, insertamos los tres roles predeterminados + 1
            DB::table('roles')->insert([
                //['name' => 'SuperAdmin', 'is_active' => true], //pendiente de eliminar
                ['name' => 'Administrador', 'is_active' => true],
                ['name' => 'Tutor', 'is_active' => true],
                ['name' => 'Veterinario', 'is_active' => true],
            ]);
        }
        else {
            $this->command->info('La tabla "roles" ya contiene datos. No se insertaron roles nuevos.');
        }
    }
}
