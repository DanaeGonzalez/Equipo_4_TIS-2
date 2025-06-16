@extends('tenant.layouts.app')

@section('content')

    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <a href="{{ url('/')}}"
                    style="background-color: var(--color-button-secondary);"
                    class="flex items-center px-4 py-2 text-white rounded hover:opacity-90">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            </div>

            <a href="{{ route('appointments.create') }}"
                style="background-color: var(--color-button-secondary);"
                class="flex items-center px-4 py-2 text-white rounded hover:opacity-90">
                    <!-- Ícono más SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Crear nueva cita
            </a>
        </div>
        
        <h2 class="text-3xl font-bold mb-6 text-center">Mis reservas</h2>

        @php
            $grouped = $appointments->groupBy(function ($item) {
                return $item->schedule->event_date; //agrupamos para mostrarlos por dia
            });
        @endphp

        @foreach($grouped as $date => $dayAppointments)
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-2 border-b pb-1">
                    @php \Carbon\Carbon::setLocale('es'); @endphp
                    {{ \Carbon\Carbon::parse($date)->isoFormat('dddd D MMMM YYYY') }}
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($dayAppointments as $appointment)
                        <div class="bg-white shadow rounded p-4 border">
                            <div class="flex justify-between items-center mb-2">
                                <div>
                                    <h4 class="text-lg font-semibold">{{ $appointment->pet->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $appointment->service->name }}</p>
                                </div>
                                <span
                                    class="px-2 py-1 rounded-full text-xs {{ $appointment->status == 'pendiente' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </div>
                            <div class="text-sm text-gray-600">
                                <p><strong>Hora:</strong> {{ $appointment->schedule->event_time }}</p>
                                <p><strong>Veterinario:</strong> {{ $appointment->user->name }}</p>
                                <p><strong>Motivo:</strong> {{ $appointment->reason }}</p>
                            </div>
                            <div class="mt-3 flex justify-end space-x-2">
                                @if($appointment->status !== 'Cancelado')
                                    <!--
                                    <a href="{{ route('appointments.edit', $appointment->id) }}"
                                        class="px-2 py-1 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition">Editar</a>//--->
                                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de eliminar esta cita?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2 py-1 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 transition">Eliminar</button>
                                    </form>
                                @else
                                    @if ($appointment->schedule->is_reserved)
                                        <button disabled
                                            class="px-2 py-1 bg-gray-400 text-white rounded-lg opacity-50 cursor-not-allowed"
                                            title="Este horario ya fue reservado por otra persona">Reactivar</button>
                                    @else
                                        <form action="{{ route('appointments.reactivate', $appointment->id) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro de reactivar esta cita?');">
                                            @csrf
                                            <button type="submit"
                                                class="px-2 py-1 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition">Reactivar</button>
                                        </form>
                                    @endif
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection