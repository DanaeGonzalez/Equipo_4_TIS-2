<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clinic;

class ClinicSeeder extends Seeder
{
    public function run(): void
    {
        if (Clinic::find('vivet')) {
            echo "El tenant 'vivet' ya existe, se omite.\n";
            return;
        }

        $tenant = Clinic::create([
            'id' => 'vivet',
            'data' => [
                'name' => 'Clínica Vivet',
                'email' => 'admin@vivet.cl',
            ],
        ]);

        //$tenant->createDatabase(); // esto es opcional y puede fallar si no configuras bien mysql

        $tenant->domains()->create([
            'domain' => 'vivet.vetcodex.test',
        ]);

        echo "✅ Clínica 'vivet' creada correctamente.\n";
    }
}
