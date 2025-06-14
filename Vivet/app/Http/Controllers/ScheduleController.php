<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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
        \Carbon\Carbon::setLocale('es');
        $user = auth()->user();
        $schedules = Schedule::where('user_id', $user->id)
            ->whereHas('appointment', function ($query) {
                $query->where('status', 'Pendiente');
            })
            ->with(['appointment.pet.client'])
            ->get()
            ->map(function ($item) {
                //  hora sin segundos
                $item->event_time = \Carbon\Carbon::parse($item->event_time)->format('H:i');
                return $item;
            })
            ->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->event_date)->locale('es')->isoFormat('dddd');
            })
            ->map(function ($day) {
                return $day->sortBy('event_time');
            });

        return view('tenant.schedules.index', compact('schedules'));
    }



    public function create()
    {
        return view('tenant.schedules.create');
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
        return view('tenant.schedules.edit', compact('schedule'));
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
   /* public function manage(Request $request)
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
        $veterinarians = User::whereHas('role', fn($q) => $q->where('name', 'Veterinario'))->get();

        return view('tenant.schedules.manage', compact('schedules', 'veterinarians'));
    }
    public function toggle(Schedule $schedule)
    {
        $schedule->is_active = !$schedule->is_active;
        $schedule->save();

        return redirect()->route('schedules.manage')->with('success', 'Horario actualizado exitosamente..');
    }*/

    public function getCalendarEvents()
    {
        $user = auth()->user();

        $schedules = Schedule::with(['appointment.pet.client'])
            ->where('user_id', $user->id)
            ->whereHas('appointment')
            ->get();

        $events = $schedules->map(function ($schedule) {
            $appointment = optional($schedule->appointment);
            $pet = optional($appointment->pet);
            $client = optional($pet->client);
            $status = $appointment->status ?? 'Sin estado';

            return [
                'title' => $pet->pet_name . ' (' . $status . ')',
                'start' => "{$schedule->event_date}T{$schedule->event_time}",
                'color' => match ($status) {
                    'Pendiente' => '#38bdf8',      // azul
                    'Finalizada' => '#10b981',     // verde
                    'Cancelado', 'Cancelada' => '#f87171', // rojo
                    default => '#d1d5db',          // gris
                },
                'extendedProps' => [
                    'appointment_id' => $appointment->id ?? null,
                    'pet_name' => $pet->pet_name ?? 'Sin mascota',
                    'client_name' => $client->name ?? 'Sin cliente',
                    'client_phone' => $client->phone ?? 'N/A',
                    'status' => $status,
                ],
            ];
        });

        return response()->json($events);
    }
    

    public function generateWeekly(Request $request)
    {
        Artisan::call('schedules:generate-weekly');

        return redirect()->back()->with('success', 'Horarios generados correctamente.');
    }


}
