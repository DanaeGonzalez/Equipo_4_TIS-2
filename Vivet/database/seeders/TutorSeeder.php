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
        // Lista de usuarios a crear o actualizar
        $users = [
            [
                'name' => 'Natalia',
                'lastname' => 'Marileo',
                'run' => 21000000,
                'email' => 'nmarileo@ing.ucsc.cl',
                'password' => '12345678',
            ],
            [
                'name' => 'César',
                'lastname' => 'Avendaño',
                'run' => 21072053,
                'email' => 'cavendano@ing.ucsc.cl',
                'password' => '12345678',
            ],
            [
                'name' => 'Pablo',
                'lastname' => 'Gonzalez',
                'run' => 12345678,
                'email' => 'pgonzalezk@ing.ucsc.cl',
                'password' => '12345678',
            ],
        ];

        foreach ($users as $userData) {
            $role = Role::find(3); 

            User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'lastname' => $userData['lastname'],
                    'run' => $userData['run'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                    'user_type' => $role->user_type,  
                    'is_active' => true,
                    'role_id' => $role->role_id,
                ]
            );

            echo "Usuario con correo {$userData['email']} creado o actualizado.\n";
        }
    }
}
