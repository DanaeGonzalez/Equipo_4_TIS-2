@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold mb-6 text-center">Mis reservas</h2>

    @php
        $grouped = $appointments->groupBy(function($item) {
            return $item->schedule->event_date;
        });
    @endphp

    @foreach($grouped as $date => $dayAppointments)
        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2 border-b pb-1">{{ \Carbon\Carbon::parse($date)->format('l d M Y') }}</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($dayAppointments as $appointment)
                <div class="bg-white shadow rounded p-4 border">
                    <div class="flex justify-between items-center mb-2">
                        <div>
                            <h4 class="text-lg font-semibold">{{ $appointment->pet->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $appointment->service->name }}</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs {{ $appointment->status == 'pendiente' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </div>
                    <div class="text-sm text-gray-600">
                        <p><strong>Hora:</strong> {{ $appointment->schedule->event_time }}</p>
                        <p><strong>Veterinario:</strong> {{ $appointment->user->name }}</p>
                        <p><strong>Motivo:</strong> {{ $appointment->reason }}</p>
                    </div>
                    <div class="mt-3 flex justify-end space-x-2">
                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="text-blue-600 hover:underline text-sm">Editar</a>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta cita?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-sm">Eliminar</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection
