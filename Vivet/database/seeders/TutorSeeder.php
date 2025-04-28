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
        $users = [
            [
                'name' => 'Natalia',
                'lastname' => 'Marileo',
                'email' => 'nmarileo@ing.ucsc.cl',
                'password' => '12345678',
            ],
            [
                'name' => 'César',
                'lastname' => 'Avendaño',
                'email' => 'cavendano@ing.ucsc.cl',
                'password' => '12345678',
            ],
            [
                'name' => 'Pablo',
                'lastname' => 'Gonzalez',
                'email' => 'pgonzalezk@ing.ucsc.cl',
                'password' => '12345678',
            ],
        ];

        foreach ($users as $userData) {
            $existingUser = User::where('email', $userData['email'])->first();
            $role = Role::find($userData['role_id']);

            if (!$existingUser) {
                // Si no existe, lo creamos
                User::create([
                    'name' => $userData['name'],
                    'lastname' => $userData['lastname'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                    'user_type' => $role->user_type,
                    'is_active' => true,
                    'role_id' => 3,
                ]);
            } else {
                // Si ya existe, podemos incluso mostrar un pequeño mensaje (opcional)
                echo "El usuario con correo {$userData['email']} ya existe. No se creó.\n";
            }
        }
    }
}
