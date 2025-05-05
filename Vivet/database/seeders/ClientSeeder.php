<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Client::create([
            'name' => 'Carlos',
            'lastname' => 'González',
            'client_run' => '12.345.678-9',   
            'email' => 'carlos@example.com',
            'phone' => '123456789',
            'address' => null,
        ]);
    }
}
