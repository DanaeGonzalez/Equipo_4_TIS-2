<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        /*Schedule::create([
            'user_id' => 1,
            'event_date' => now()->addDays(1)->format('Y-m-d'),
            'event_time' => '10:00',
            'event_type' => 'Consulta',
            'is_reserved' => true
        ]);

        Schedule::create([
            'user_id' => 1,
            'event_date' => now()->addDays(1)->format('Y-m-d'),
            'event_time' => '11:00',
            'event_type' => 'algo',
            'is_reserved' => true
        ]);

        Schedule::create([
            'user_id' => 1,
            'event_date' => now()->addDays(2)->format('Y-m-d'),
            'event_time' => '11:00',
            'event_type' => 'Vacunación',
            'is_reserved' => 0
        ]);

        Schedule::create([
            'user_id' => 1,
            'event_date' => now()->addDays(3)->format('Y-m-d'),
            'event_time' => '12:30',
            'event_type' => 'Cirugía menor',
            'is_reserved' => 0
        ]);*/
    }
}
