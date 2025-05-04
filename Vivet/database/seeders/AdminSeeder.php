<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name', 'Administrador')->first();

        if (!$role) {
            throw new \Exception("El rol 'Administrador' no fue encontrado. Asegúrate de haberlo creado.");
        }
        // Lista de usuarios a crear o actualizar
        $users = [
            [
                'name' => 'Danae',
                'lastname' => 'González',
                'run' => 22293459,
                'email' => 'dgonzalezv@ing.ucsc.cl',
                'password' => 'password',
                'sex' => 'Mujer',
            ],
            [
                'name' => 'Javier',
                'lastname' => 'Pino',
                'run' => 22293459,
                'email' => 'jpinoh@ing.ucsc.cl',
                'password' => 'password',
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
                    'role_id' => $role->role_id,
                ]
            );

            echo $user->wasRecentlyCreated
            ? "Usuario {$userData['email']} creado.\n"
            : "Usuario {$userData['email']} actualizado.\n";
        }
    }
}
