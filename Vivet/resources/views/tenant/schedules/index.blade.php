@extends('tenant.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl  mb-6 text-center">Agenda Semanal de Horarios Reservados</h2>

        <div class="grid grid-cols-1  md:grid-cols-3 lg:grid-cols-6 gap-4 ">
            @foreach(['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'] as $day)
                <div class="bg-white shadow rounded p-3">
                    <h3 class="font-semibold text-center capitalize mb-2">{{ ucfirst($day) }}</h3>
                    @if($schedules->has($day))
                        @foreach($schedules[$day] as $schedule)
                            @if($schedule->appointment)
                                @php
                                    $isFinalizada = $schedule->appointment->status === 'Finalizada';
                                @endphp

                                <div class="block max-w-sm text-white p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 {{ $isFinalizada ? 'opacity-50' : '' }}"
                                    style="background-color: var(--color-button-secondary);">
                                    <strong>Hora:</strong> {{ $schedule->event_time }} <br>
                                    <strong>Mascota:</strong> {{ $schedule->appointment->pet->pet_name }} <br>
                                    <strong>Dueño:</strong> {{ $schedule->appointment->pet->client->name }} <br>
                                    <strong>Teléfono:</strong> {{ $schedule->appointment->pet->client->phone }}

                                    <div class="mt-3 flex justify-center">
                                        <form action="{{ route('appointments.cancel', $schedule->appointment->id) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro de cancelar esta cita?');">
                                            @csrf
                                            <button type="submit"
                                                class="mt-1 px-2 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600">
                                                Cancelar Cita
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="mb-2 p-2 bg-yellow-100 rounded text-sm">
                                    {{ $schedule->event_time }} - Sin detalles
                                </div>
                            @endif
                        @endforeach
                    @else
                        <p class="text-center text-gray-500 text-sm">Sin reservas</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection