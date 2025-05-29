<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use Carbon\Carbon;

class MarkPastAppointmentsExpired extends Command
{
    protected $signature = 'appointments:mark-expired';
    protected $description = 'Marca como expiradas las citas cuya fecha y hora ya pasaron';

    public function handle()
    {
        $now = Carbon::now();

        $expiredAppointments = Appointment::whereHas('schedule', function ($query) use ($now) {
            $query->where('event_date', '<', $now->format('Y-m-d'))
                ->orWhere(function ($q) use ($now) {
                    $q->where('event_date', '=', $now->format('Y-m-d'))
                        ->where('event_time', '<', $now->format('H:i:s'));
                });
        })->where('status', '!=', 'Finalizada')->get();

        $count = 0;

        foreach ($expiredAppointments as $appointment) {
            $appointment->status = 'Finalizada';  // o 'expirada', según tu lógica
            $appointment->save();

            $appointment->schedule->is_reserved = 0;  // liberar el horario
            $appointment->schedule->save();

            $count++;
        }

        $this->info("Se marcaron $count citas como finalizadas y se liberaron sus horarios.");
    }
    /*comando para finalizar las horas que ya caducaronphp artisan appointments:mark-expired
*/ 
}
