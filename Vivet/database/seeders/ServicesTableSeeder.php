<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesTableSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'name' => 'Vacunación',
            'description' => 'hola',
            'estimated_duration' => 1,
            'price' => '13000',
            'icon' => null,
            'is_active'=> true,
        ]);
        
        Service::create([
            'name' => 'Desparasitación',
            'description' => 'hola',
            'estimated_duration' => 2,
            'price' => '15000',
            'icon' => null,
            'is_active'=> true,
        ]);

        Service::create([
            'name' => 'Consulta general',
            'description' => 'hola',
            'estimated_duration' => 3,
            'price' => '10000',
            'icon' => null,
            'is_active'=> false,
        ]);
    }
}
