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
            'price' => '13000'

    
        ]);
        
        Service::create([
            'name' => 'Desparasitación',
            'price' => '15000'
        ]);

        Service::create([
            'name' => 'Consulta general',
            'price' => '10000'
        ]);
    }
}
