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
            // Si está vacía, insertamos los tres roles predeterminados
            DB::table('roles')->insert([
                ['user_type' => 'SuperAdmin', 'is_active' => true],
                ['user_type' => 'Administrador', 'is_active' => true],
                ['user_type' => 'Tutor', 'is_active' => true],
            ]);
        }
        else {
            $this->command->info('La tabla "roles" ya contiene datos. No se insertaron roles nuevos.');
        }
    }
}
