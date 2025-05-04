@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6 text-center">Agenda Semanal de Horarios Reservados</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
        @foreach(['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'] as $day)
        <div class="bg-white shadow rounded p-3">
            <h3 class="font-semibold text-center capitalize mb-2">{{ ucfirst($day) }}</h3>
            @if($schedules->has($day))
                @foreach($schedules[$day] as $schedule)
                    @if($schedule->appointment)
                        <div class="mb-2 p-2 bg-green-100 rounded text-sm">
                            {{ $schedule->event_time }} - {{ $schedule->appointment->pet->name }}
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
