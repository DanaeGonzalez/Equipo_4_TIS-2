<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ManageSchedulesController extends Controller
{
    public function manage(Request $request)
    {
        $query = Schedule::with('user')->orderBy('event_date')->orderBy('event_time');

        if ($request->filled('date')) {
            $query->where('event_date', $request->date);
        }

        if ($request->filled('veterinarian_id')) {
            $query->where('user_id', $request->veterinarian_id);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active' ? true : false);
        }

        $schedules = $query->paginate(20);
        $veterinarians = User::whereHas('role', function ($q) {
            $q->where('name', 'Veterinario');
        })->get();

        return view('tenant.manageschedules.manage', compact('schedules', 'veterinarians'));
    }

    public function toggle(Schedule $schedule)
    {
        $schedule->is_active = !$schedule->is_active;
        $schedule->save();

        return redirect()->route('manageschedules.manage')->with('success', 'Horario actualizado exitosamente.');
    }
}
