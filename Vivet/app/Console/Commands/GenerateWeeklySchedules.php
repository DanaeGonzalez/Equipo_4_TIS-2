<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Schedule;
use Carbon\Carbon; // libreria que trabaja con fechas

class GenerateWeeklySchedules extends Command
{
    
    protected $signature = 'schedules:generate-weekly';

    protected $description = 'Genera horarios automáticamente para la próxima semana, de lunes a viernes de 10:00 a 19:00 horas.';

    /**
     * Lógica principal del comando.
     */
    public function handle()
    {
        $startDate = Carbon::now()->addWeek()->startOfWeek(Carbon::MONDAY);

        for ($day = 0; $day < 6; $day++) {
            $date = $startDate->copy()->addDays($day);

            for ($hour = 10; $hour <= 19; $hour++) {
                if ($hour === 13) {// aca nos saltamos el horario de almuerzo
                    continue;
                }
                Schedule::firstOrCreate([
                    'event_date' => $date->toDateString(),
                    'event_time' => sprintf('%02d:00:00', $hour),
                ], [
                    'is_reserved' => 0,
                    
                ]);
            }
        }

        $this->info(' Horarios generados exitosamente para la semana del ' . $startDate->toDateString());
    }
}
