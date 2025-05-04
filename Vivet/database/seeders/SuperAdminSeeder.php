<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        $role = Role::find(1); 

        User::updateOrCreate(
            ['email' => 'admin@admin.com'], 
            [ 
                'name' => 'Danae',
                'lastname'=> 'González',
                'run' => 21065316,
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'user_type' => $role->name,
                'is_active' => true,
                'role_id' => $role->role_id,
            ]
        );
    }
}
