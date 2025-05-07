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
        $startDate = Carbon::now()->startOfWeek(Carbon::MONDAY); //->addWeek()

        for ($day = 0; $day < 6; $day++) {
            $date = $startDate->copy()->addDays($day);

            // Si la fecha es menor a hoy → saltar
            if ($date->isBefore(Carbon::today())) {
                continue;
            }

            for ($hour = 10; $hour <= 19; $hour++) {
                if ($hour === 13) {// aca nos saltamos el horario de almuerzo
                    continue;
                }
                Schedule::firstOrCreate([
                    'event_date' => $date->toDateString(),
                    'event_time' => sprintf('%02d:00:00', $hour),
                    'user_id' => 2, // asigna al usuario con ID 2 , que es admi
                ], [
                    'is_reserved' => 0,
                    'event_type' => 'general', // valor por defecto

                ]);
            }
        }
        /* php artisan schedules:generate-weekly  con eso por terminal generas los horarios*/
        $this->info(' Horarios generados exitosamente para la semana del ' . $startDate->toDateString());
    }
}
