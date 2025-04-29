<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Superadmin;
use Illuminate\Support\Facades\Hash;

class SuperadminSeeder extends Seeder
{
    public function run(): void
    {
        if (!Superadmin::where('email', 'superadmin@example.com')->exists()) {
            Superadmin::create([
                'name' => 'Javier',
                'email' => 'jpinoh@ing.ucsc.cl',
                'password' => Hash::make('password'), 
            ]);
        } else {
            $this->command->info('Ya existe un superadmin registrado.');
        }
    }
}
