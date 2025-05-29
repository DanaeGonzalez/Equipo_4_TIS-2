@extends('tenant.layouts.app')
@include('tenant.partials.colors')

@section('title', 'Fichas Clínicas')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Fichas Clínicas</h1>

    {{-- Alerta de éxito --}}
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabla --}}
    <div class="relative overflow-x-auto rounded-lg shadow-md">
        <table class="w-full text-sm text-left text-gray-700 bg-white border border-gray-200 rounded-lg">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Fecha</th>
                    <th scope="col" class="px-6 py-3">Mascota</th>
                    <th scope="col" class="px-6 py-3">Cliente</th>
                    <th scope="col" class="px-6 py-3">Veterinario</th>
                    <th scope="col" class="px-6 py-3">Diagnóstico</th>
                    <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $record)
                    <tr class="bg-white border-b hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $record->date->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4">{{ $record->pet->pet_name ?? '-' }}</td>
                        <td class="px-6 py-4">
                            {{ $record->pet->client->name ?? '' }} {{ $record->pet->client->lastname ?? '' }}
                        </td>
                        <td class="px-6 py-4">{{ $record->vet->name ?? '-' }}</td>
                        <td class="px-6 py-4">{{ Str::limit($record->diagnosis, 40) }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('clinical_records.edit', $record->id) }}"
                               class="inline-block px-4 py-2 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 transition">
                                Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No hay fichas clínicas registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
