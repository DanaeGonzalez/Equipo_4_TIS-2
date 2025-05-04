<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Juan ',
            'lastname' => 'Pérez',
            'email' => 'juan@vet.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'is_active' => 1,
        ]);

        User::create([
            'name' => 'María',
            'lastname' => 'López',
            'email' => 'maria@vet.com',
            'password' => bcrypt('password'),
            'role_id' => 4,
            'is_active' => 1,
        ]);
    }
}
