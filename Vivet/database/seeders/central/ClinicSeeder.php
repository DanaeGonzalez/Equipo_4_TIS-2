<?php

namespace Database\Seeders\Central;

use Illuminate\Database\Seeder;
use App\Models\Clinic;

class ClinicSeeder extends Seeder
{
    public function run(): void
    {
        $clinic = Clinic::create([
            'name' => 'Clínica Vivet',
            'subdomain' => 'vivet',
            'domain' => 'vivet.vetcodex.test',
            'email' => 'admin@vivet.cl',
        ]);

        $clinic->createDatabase();
        $clinic->domains()->create(['domain' => $clinic->domain]);
    }
}
