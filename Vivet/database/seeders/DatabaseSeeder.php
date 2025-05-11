<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            PermissionRouteSeeder::class,
            RolesTableSeeder::class,
            //SuperAdminSeeder::class,
            TutorSeeder::class,
            VeterinarioSeeder::class,
            AdminSeeder::class,
            ServicesTableSeeder::class,
        ]);
        
    }
    
}
