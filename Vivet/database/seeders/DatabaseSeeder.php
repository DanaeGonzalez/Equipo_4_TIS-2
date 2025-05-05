<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            SuperAdminSeeder::class,
            ScheduleSeeder::class,
            UsersTableSeeder::class,
            PetsTableSeeder::class,
            ServicesTableSeeder::class,
            
            TutorSeeder::class,
            VeterinarioSeeder::class,
        ]);
        
    }
    
}
