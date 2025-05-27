<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class TutorSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::where('name', 'Tutor')->first();

        if (!$role) {
            throw new \Exception("El rol 'Tutor' no fue encontrado. Asegúrate de haberlo creado en el RoleSeeder.");
        }
        // Lista de usuarios a crear o actualizar
        $users = [
            [
                'name' => 'Natalia',
                'lastname' => 'Marileo',
                'run' => 21000000,
                'email' => 'nmarileo@ing.ucsc.cl',
                'password' => '12345678',
                'sex' => 'Mujer',
            ],
            [
                'name' => 'César',
                'lastname' => 'Avendaño',
                'run' => 21072053,
                'email' => 'cavendano@ing.ucsc.cl',
                'password' => '12345678',
                'sex' => 'Hombre',
            ],
            [
                'name' => 'Pablo',
                'lastname' => 'Gonzalez',
                'run' => 12345678,
                'email' => 'pgonzalezk@ing.ucsc.cl',
                'password' => '12345678',
                'sex' => 'Hombre',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'lastname' => $userData['lastname'],
                    'run' => $userData['run'],
                    'sex' => $userData['sex'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                    'user_type' => $role->name,  
                    'is_active' => true,
                    'role_id' => $role->id,
                ]
            );

            echo $user->wasRecentlyCreated
            ? "Usuario {$userData['email']} creado.\n"
            : "Usuario {$userData['email']} actualizado.\n";
        }
    }
}
