@extends('tenant.layouts.app')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Historial de atención</h1>

    <!-- Filtro -->
    <form method="GET" action="{{ route('clinical_history.index') }}" class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mp-2">
            <div>
                <label class="block text-sm font-semibold mb-1">Nombre del cliente:</label>
                <input type="text" name="client_name" placeholder="Juan" value="{{ request('client_name') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            
            <div>
                <label class="block text-sm font-semibold mb-1">Nombre del paciente:</label>
                <input type="text" name="pet_name" placeholder="Pepe" value="{{ request('pet_name') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            
            <div>
                <label class="block text-sm font-semibold mb-1">Fecha inicio</label>
                <input type="date" name="from_date" value="{{ request('from_date') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            
            <div>
                <label class="block text-sm font-semibold mb-1">Fecha final</label>
                <input type="date" name="to_date" value="{{ request('to_date') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">   
            </div>     
        </div>

        <div class="mt-4">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
                Filtrar
            </button>
        </div>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mascota</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Veterinaria
                    </th> <!--aca va a salir la persona que hizo el historial-->
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sintomas</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diagnostico
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tratamiento
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notas</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($records as $record)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $record->date->format('d-m-Y') }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $record->pet->pet_name ?? 'Sin mascota' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $record->pet->client->name . ' ' . $record->pet->client->lastname ?? 'Sin cliente' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $record->vet->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $record->symptoms }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $record->diagnosis }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $record->treatment }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $record->notes }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-3 text-center text-sm text-gray-500">No clinical records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4">
            {{ $records->links() }}
        </div>
    </div>
@endsection