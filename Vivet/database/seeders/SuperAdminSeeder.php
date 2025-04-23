<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::create([
                'name' => 'Danae',
                'lastname'=> 'Gonzalez',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'user_type' => 'SuperAdmin',
                'is_active' => true,
                'role_id' => 1,
            ]);
        }
        else{
            $this->command->info('La tabla "users" ya contiene a Danae');
        }
    }
}

