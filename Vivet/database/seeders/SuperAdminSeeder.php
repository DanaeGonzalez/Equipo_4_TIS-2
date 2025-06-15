<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $users = [
            [
                'name' => 'Danae',
                'email' => 'dgonzalezv@ing.ucsc.cl',
                'password' => 'password',
            ],
            [
                'name' => 'Javier',
                'email' => 'jpinoh@ing.ucsc.cl',
                'password' => 'password',
            ],
        ];
        foreach ($users as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password'])
                ]
            );

            echo $user->wasRecentlyCreated
                ? "Usuario {$userData['email']} creado.\n"
                : "Usuario {$userData['email']} actualizado.\n";
        }
    }
}