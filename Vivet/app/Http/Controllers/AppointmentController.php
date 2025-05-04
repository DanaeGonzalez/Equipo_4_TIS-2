<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Schedule;
use App\Models\Pet;
use App\Models\Service;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class AppointmentController extends Controller
{
    public function create()
    {
        $schedules = Schedule::where('is_reserved', 0)->get();
        $services = Service::all();
        $veterinarians = User::where('role_id', 4)->where('is_active', 1)->get();

        return view('appointments.create', compact('schedules', 'services', 'veterinarians'));
    }

    public function index()
    {
        $appointments = Appointment::with(['pet', 'user', 'service', 'schedule'])
        ->orderBy('appointment_date')// ordena por fecha completa
        ->get();
        return view('appointments.index', compact('appointments'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'rut' => 'required|string|max:12',
                'email' => 'required|email',
                'phone' => 'required|string',
                'address' => 'nullable|string',

                'pet_name' => 'required|string|max:255',
                'species' => 'required|string|max:255',
                'breed' => 'nullable|string|max:255',
                'sex' => 'required|in:macho,hembra',
                'color' => 'nullable|string|max:255',
                'date_of_birth' => 'nullable|date',
                'microchip_number' => 'nullable|string|max:255',
                'notes' => 'nullable|string',

                'schedule_id' => 'required|exists:schedules,id',
                'service_id' => 'required|exists:services,id',
                'user_id' => 'required|exists:users,id',
                'reason' => 'required|string',
            ]);

            $schedule = Schedule::findOrFail($request->schedule_id);
            if ($schedule->is_reserved) {
                return back()->withErrors(['schedule_id' => 'Este horario ya fue reservado.']);
            }

            $veterinarian = User::where('id', $request->user_id)
                ->where('role_id', 4)
                ->where('is_active', 1)
                ->first();

            if (!$veterinarian) {
                return back()->withErrors(['user_id' => 'El veterinario seleccionado no es válido.']);
            }

            $client = Client::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'rut' => $request->rut,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            $pet = Pet::create([
                'client_id' => $client->id,
                'name' => $request->pet_name,
                'species' => $request->species,
                'breed' => $request->breed,
                'sex' => $request->sex,
                'color' => $request->color,
                'date_of_birth' => $request->date_of_birth,
                'microchip_number' => $request->microchip_number,
                'notes' => $request->notes,
            ]);

            Appointment::create([
                'schedule_id' => $schedule->id,
                'pet_id' => $pet->id,
                'user_id' => $veterinarian->id,
                'service_id' => $request->service_id,
                'appointment_date' => $schedule->event_date . ' ' . $schedule->event_time,
                'reason' => $request->reason,
                'status' => 'pendiente',
            ]);

            $schedule->update(['is_reserved' => 1]);

            return redirect()->route('appointments.create')->with('success', 'Cita registrada correctamente.');
        } catch (Exception $e) {
            Log::error('Error al registrar cita: ' . $e->getMessage());
            return back()->withErrors(['general' => 'Ocurrió un error al registrar la cita. Intenta nuevamente.']);
        }
    }

    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', compact('appointment'));
    }
    public function update(Request $request, Appointment $appointment)
    {
        //  actualizar cita 
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Cita eliminada correctamente.');
    }

}
