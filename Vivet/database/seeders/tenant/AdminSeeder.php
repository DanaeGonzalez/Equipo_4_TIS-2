<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name', 'Administrador')->first();

        if (!$role) {
            $role = Role::firstOrCreate(
                ['name' => 'Administrador'],
                ['is_active' => true]
            );
        }
        // Lista de usuarios a crear o actualizar
        $users = [
            [
                'name' => 'Danae',
                'lastname' => 'González',
                'run' => 21065316,
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
                    'role_id' => $role->id,
                ]
            );

            echo $user->wasRecentlyCreated
                ? "Usuario {$userData['email']} creado.\n"
                : "Usuario {$userData['email']} actualizado.\n";
        }
        $allPermissions = Permission::pluck('id');
        $role->permissions()->sync($allPermissions);

        $this->command->info("Todos los permisos asignados al rol Administrador.");
    }
}
