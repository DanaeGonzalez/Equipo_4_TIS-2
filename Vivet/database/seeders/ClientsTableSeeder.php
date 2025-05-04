<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientsTableSeeder extends Seeder
{
    public function run()
    {
        Client::create([
            'first_name' => 'Carlos',
            'last_name' => 'González',
            'rut' => '12.345.678-9',   
            'email' => 'carlos@example.com',
            'phone' => '123456789',
        ]);
    }
}
