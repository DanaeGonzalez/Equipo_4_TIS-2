<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pet;

class PetsTableSeeder extends Seeder
{
    public function run()
    {
        Pet::create(['name' => 'Firulais', 'client_id' => 1, 'species' => 'Perro', 'sex' => 'Macho']);
        Pet::create(['name' => 'Michi', 'client_id' => 1, 'species' => 'Gato', 'sex' => 'Hembra']);
        Pet::create(['name' => 'Rocky', 'client_id' => 1, 'species' => 'Perro', 'sex' => 'Macho']);
    }
}
