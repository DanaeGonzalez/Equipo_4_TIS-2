<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class VeterinarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name', 'Veterinario')->first();

        if (!$role) {
            throw new \Exception("El rol 'Veterinario' no fue encontrado. Asegúrate de haberlo creado en el RoleSeeder.");
        }
        // Lista de usuarios a crear o actualizar
        $users = [
            [
                'name' => 'Viviana',
                'lastname' => 'Vivet',
                'run' => 16589123,
                'email' => 'vivet@gmail.cl',
                'password' => '12345678',
                'sex' => 'Mujer',
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
