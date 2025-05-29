<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{

    public function __construct()//solo admi y veterinaria pueden acceder
    {
        /*$this->middleware(function ($request, $next) {
            if (!auth()->check() || !in_array(auth()->user()->role_id, [1, 3])) {
                return redirect('/')->withErrors(['access' => 'No tienes permiso para acceder a esta sección.']);
            }
            return $next($request);
        });*/
    }
    public function index()
    {
        $schedules = Schedule::where('is_reserved', 1)
            ->with(['appointment.pet']) // trae cita + mascota
            ->get()
            ->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->event_date)->locale('es')->isoFormat('dddd'); 
            })
            ->map(function ($day) {
                return $day->sortBy('event_time'); //ordena horario x dia
            });

        return view('schedules.index', compact('schedules'));
    }


    public function create()
    {
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_date' => 'required|date',
            'event_time' => 'required',
        ]);

        Schedule::create([
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'is_reserved' => 0,
        ]);

        return redirect()->route('schedules.index')->with('success', 'Horario creado correctamente.');
    }

    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'event_date' => 'required|date',
            'event_time' => 'required',
        ]);

        $schedule->update($request->only('event_date', 'event_time'));

        return redirect()->route('schedules.index')->with('success', 'Horario actualizado correctamente.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Horario eliminado correctamente.');
    }
}
