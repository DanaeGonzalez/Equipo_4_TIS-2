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
    public function __construct()
    {
        /*$this->middleware(function ($request, $next) {
            if (!auth()->check() || !in_array(auth()->user()->role_id, [1, 3])) {
                return redirect('/')->withErrors(['access' => 'No tienes permiso para acceder a esta sección.']);
            }
            return $next($request);
        });*/
    }
    public function create()
    {
        $now = \Carbon\Carbon::now();

        $schedules = Schedule::where('is_reserved', 0)
            ->where(function ($query) use ($now) {
                $query->where('event_date', '>', $now->format('Y-m-d'))
                    ->orWhere(function ($q) use ($now) {
                        $q->where('event_date', '=', $now->format('Y-m-d'))
                            ->where('event_time', '>', $now->format('H:i:s'));
                    });
            })->get();

        $services = Service::all();
        $veterinarians = User::where('role_id', 3)->where('is_active', 1)->get();

        $user = auth()->user();

        if ($user->role->name === 'Tutor') {
            $client = Client::where('client_run', $user->run)->first();
            // Agrega esta validación antes de acceder a client->pets
            if (!$client) {
                $client = Client::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'lastname' => $user->lastname,
                    'email' => $user->email,
                    'client_run' => $user->run,
                ]);
            }
            // Cargar la relación para que esté disponible en el usuario
            $client->load('pets');
            $pets = $client->pets; // acá ya no debería fallar
        } else {
            $pets = collect(); // O lo que uses si no es tutor
        }

        return view('appointments.create', compact('schedules', 'services', 'veterinarians', 'pets'));
    }

    public function index()
    {
        $appointments = Appointment::with(['pet', 'user', 'service', 'schedule'])
            ->where('status', '!=', 'Finalizada')
            ->orderBy('appointment_date')
            ->get();
        return view('appointments.index', compact('appointments'));
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();

            if ($user->role->name === 'Tutor') {
                $request->validate([
                    'schedule_id' => 'required|exists:schedules,id',
                    'service_id' => 'required|exists:services,id',
                    'vet_id' => 'required|exists:users,id',
                    'reason' => 'required|string',

                    // Ahora pet_id es obligatorio (porque viene del select)
                    'pet_id' => 'required|string',

                    // Datos de mascota requeridos solo si pet_id es 'new'
                    'pet_name' => 'required_if:pet_id,new|string|max:255',
                    'species' => 'required_if:pet_id,new|string|max:255',
                    'breed' => 'nullable|string|max:255',
                    'color' => 'nullable|string|max:255',
                    'sex' => 'required_if:pet_id,new|in:Macho,Hembra',
                    'date_of_birth' => 'nullable|date',
                    'microchip_number' => 'nullable|string|max:255',
                    'notes' => 'nullable|string',
                ]);

                $schedule = Schedule::findOrFail($request->schedule_id);
                if ($schedule->is_reserved) {
                    return back()->withErrors(['schedule_id' => 'Este horario ya fue reservado.']);
                }

                $veterinarian = User::where('id', $request->vet_id)
                    ->where('role_id', 3)
                    ->where('is_active', 1)
                    ->first();

                if (!$veterinarian) {
                    return back()->withErrors(['user_id' => 'El veterinario seleccionado no es válido.']);
                }

                $client = Client::where('client_run', $user->run)->first();
                if (!$client) {
                    $client = Client::create([
                        'user_id' => $user->id,
                        'name' => $user->name,
                        'lastname' => $user->lastname,
                        'email' => $user->email,
                        'client_run' => $user->run,
                    ]);
                }

                if ($request->pet_id !== 'new') {
                    $pet = Pet::findOrFail($request->pet_id);
                } else {
                    $pet = Pet::create([
                        'client_id' => $client->id,
                        'pet_name' => $request->pet_name,
                        'species' => $request->species,
                        'breed' => $request->breed,
                        'color' => $request->color,
                        'sex' => $request->sex,
                        'date_of_birth' => $request->date_of_birth,
                        'microchip_number' => $request->microchip_number,
                        'notes' => $request->notes,
                    ]);
                }

                Appointment::create([
                    'schedule_id' => $schedule->id,
                    'pet_id' => $pet->id,
                    'vet_id' => $veterinarian->id,
                    'service_id' => $request->service_id,
                    'appointment_date' => $schedule->event_date . ' ' . $schedule->event_time,
                    'reason' => $request->reason,
                    'status' => 'pendiente',
                ]);

                $schedule->update(['is_reserved' => 1]);

                return redirect()->route('appointments.create')->with('success', 'Cita registrada correctamente.');
            }

            // Para admin y veterinaria dejamos tu código intacto
            $request->validate([
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'client_run' => 'required|string|max:12',
                'email' => 'required|email',
                'phone' => 'required|string',
                'address' => 'nullable|string',

                'pet_name' => 'required|string|max:255',
                'species' => 'required|string|max:255',
                'breed' => 'nullable|string|max:255',
                'color' => 'nullable|string|max:255',
                'sex' => 'required|in:Macho,Hembra',
                'date_of_birth' => 'nullable|date',
                'microchip_number' => 'nullable|string|max:255',
                'notes' => 'nullable|string',

                'schedule_id' => 'required|exists:schedules,id',
                'service_id' => 'required|exists:services,id',
                'vet_id' => 'required|exists:users,id',
                'reason' => 'required|string',
            ]);

            $schedule = Schedule::findOrFail($request->schedule_id);
            if ($schedule->is_reserved) {
                return back()->withErrors(['schedule_id' => 'Este horario ya fue reservado.']);
            }

            $veterinarian = User::where('id', $request->vet_id)
                ->where('role_id', 3)
                ->where('is_active', 1)
                ->first();

            if (!$veterinarian) {
                return back()->withErrors(['user_id' => 'El veterinario seleccionado no es válido.']);
            }

            $client = Client::where('client_run', $request->client_run)->first();

            if ($client) {
                if ($client->email !== $request->email) {
                    return back()->withErrors([
                        'email' => 'Ya existe un cliente con este RUT pero con otro correo.',
                    ]);
                }
            } else {
                $client = Client::create([
                    'user_id' => auth()->id(),
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'client_run' => $request->client_run,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]);
            }

            $pet = Pet::create([
                'client_id' => $client->id,
                'pet_name' => $request->pet_name,
                'species' => $request->species,
                'breed' => $request->breed,
                'color' => $request->color,
                'sex' => $request->sex,
                'date_of_birth' => $request->date_of_birth,
                'microchip_number' => $request->microchip_number,
                'notes' => $request->notes,
            ]);

            Appointment::create([
                'schedule_id' => $schedule->id,
                'pet_id' => $pet->id,
                'vet_id' => $veterinarian->id,
                'service_id' => $request->service_id,
                'appointment_date' => $schedule->event_date . ' ' . $schedule->event_time,
                'reason' => $request->reason,
                'status' => 'pendiente',
            ]);

            $schedule->update(['is_reserved' => 1]);

            return redirect()->route('appointments.create')->with('success', 'Cita registrada correctamente.');
        } catch (Exception $e) {
            Log::error('Error al registrar cita: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return back()->withErrors(['general' => 'Ocurrió un error al registrar la cita. Intenta nuevamente.']);
        }
    }

    public function edit(Appointment $appointment)
    {
        $appointment->load('client', 'pet', 'service', 'user', 'schedule');
        $services = Service::all();
        $veterinarians = User::where('role_id', 3)->where('is_active', 1)->get();
        $schedules = Schedule::where('is_reserved', false)->get();


        return view('appointments.edit', compact('appointment', 'services', 'veterinarians', 'schedules'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'client_run' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'pet_name' => 'required|string',
            'species' => 'required|string',
            'breed' => 'nullable|string',
            'color' => 'nullable|string',
            'sex' => 'required|string',
            'date_of_birth' => 'nullable|date',
            'microchip_number' => 'nullable|string',
            'notes' => 'nullable|string',
            'service_id' => 'required|exists:services,id',
            'vet_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
            'reason' => 'required|string',
        ]);

        // Actualiza cliente
        $appointment->client->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'client_run' => $request->client_run,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Actualiza mascota
        $appointment->pet->update([
            'name' => $request->pet_name,
            'species' => $request->species,
            'breed' => $request->breed,
            'color' => $request->color,
            'sex' => $request->sex,
            'date_of_birth' => $request->date_of_birth,
            'microchip_number' => $request->microchip_number,
            'notes' => $request->notes,
        ]);

        // Actualiza cita
        $appointment->update([
            'service_id' => $request->service_id,
            'vet_id' => $request->vet_id,
            'schedule_id' => $request->schedule_id,
            'reason' => $request->reason,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Cita actualizada correctamente.');
    }


    public function destroy(Appointment $appointment)
    {
        // Cambiar el estado a "Cancelada"
        //$appointment->status = 'Cancelado';
        //$appointment->save();
        // Verifica si tiene un horario asociado y libéralo
        if ($appointment->schedule) {
            $appointment->schedule->is_reserved = false;
            $appointment->schedule->save();
        }
        // Eliminar realmente la cita
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Cita eliminada correctamente.');
    }
    public function cancel(Appointment $appointment)
    {
        $appointment->status = 'Cancelado'; // O el estado que uses, puede ser 'cancelado'
        $appointment->save();

        // se podra  liberar el horario
        $appointment->schedule->is_reserved = false;
        $appointment->schedule->save();
        return redirect()->back()->with('success', 'La cita ha sido cancelada exitosamente.');
    }
    public function reactivate(Appointment $appointment)
    {
        if ($appointment->schedule->is_reserved) {
            return redirect()->back()->withErrors(['error' => 'No se puede reactivar la cita. El horario ya fue reservado por otra persona.']);
        }
        $appointment->status = 'Activar'; //  estados activos
        $appointment->save();

        $appointment->schedule->is_reserved = true;
        $appointment->schedule->save();

        return redirect()->back()->with('success', 'La cita ha sido reactivada exitosamente.');
    }


}
