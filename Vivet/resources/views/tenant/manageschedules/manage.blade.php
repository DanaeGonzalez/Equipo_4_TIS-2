@extends('tenant.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Administrar los horarios</h2>

        {{-- Filtros --}}
        <form method="GET" action="{{ route('manageschedules.manage') }}" class="mb-6 flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-sm font-semibold mb-1">Fecha</label>
                <input type="date" name="date" value="{{ request('date') }}" class="border px-3 py-2 rounded w-48">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Veterinario</label>
                <select name="veterinarian_id" class="border px-3 py-2 rounded w-48">
                    <option value="">-- Todos --</option>
                    @foreach($veterinarians as $vet)
                        <option value="{{ $vet->id }}" @selected(request('veterinarian_id') == $vet->id)>
                            {{ $vet->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Estado</label>
                <select name="status" class="border px-3 py-2 rounded w-48">
                    <option value="">-- All --</option>
                    <option value="active" @selected(request('status') === 'active')>Activo</option>
                    <option value="inactive" @selected(request('status') === 'inactive')>Inactivo</option>
                </select>
            </div>

            <div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Filtrar
                </button>
            </div>
        </form>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('schedules.generate-weekly') }}" method="POST" class="mb-4">
            @csrf
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                Generar horarios semanal
            </button>
        </form>

        {{-- Tabla --}}
        <table class="w-full text-center border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">Fecha</th>
                    <th class="border px-3 py-2">Horario</th>
                    <th class="border px-3 py-2">Veterinario</th>
                    <th class="border px-3 py-2">Estado</th>
                    <th class="border px-3 py-2">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schedules as $schedule)
                    <tr>
                        <td class="border px-3 py-2">{{ $schedule->event_date }}</td>
                        <td class="border px-3 py-2">{{ \Carbon\Carbon::parse($schedule->event_time)->format('H:i') }}</td>
                        <td class="border px-3 py-2">{{ $schedule->user->name ?? 'Unassigned' }}</td>
                        <td class="border px-3 py-2">
                            @if($schedule->is_active)
                                <span class="text-green-600 font-semibold">Activo</span>
                            @else
                                <span class="text-red-600 font-semibold">Inactivo</span>
                            @endif
                        </td>
                        <td class="border px-3 py-2">
                            <form method="POST" action="{{ route('manageschedules.toggle', $schedule->id) }}">
                                @csrf
                                <button type="submit" class="px-3 py-1 rounded bg-blue-500 text-white hover:bg-blue-600">
                                    {{ $schedule->is_active ? 'Desactivado' : 'Activado' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">No hay horario.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $schedules->appends(request()->query())->links() }}
        </div>

    </div>
@endsection