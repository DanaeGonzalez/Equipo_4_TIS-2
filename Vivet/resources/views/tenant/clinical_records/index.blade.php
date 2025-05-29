@extends('tenant.layouts.app')
@include('tenant.partials.colors')

@section('title', 'Fichas Clínicas')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Fichas Clínicas</h1>

    @if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    {{-- Buscador + Botón Crear --}}
    <div class="flex items-center justify-between mb-4 w-full flex-wrap gap-2">
        {{-- Buscador --}}
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" id="table-search" placeholder="Buscar ficha..."
                class="block ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" />
        </div>

        {{-- Botón Nueva Ficha --}}
        @can('clinical_records.create')
        <a href="{{ route('clinical_records.create') }}"
            class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            + Nueva Ficha Clínica
        </a>
        @endcan
    </div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        {{-- Tabla --}}
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                            <label for="checkbox-all" class="sr-only">Seleccionar todo</label>
                        </div>
                    </th>
                    <th class="px-6 py-3">Fecha</th>
                    <th class="px-6 py-3">Mascota</th>
                    <th class="px-6 py-3">Cliente</th>
                    <th class="px-6 py-3">Veterinario</th>
                    <th class="px-6 py-3">Diagnóstico</th>
                    <th class="px-6 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $record)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-{{ $record->id }}" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                            <label for="checkbox-{{ $record->id }}" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $record->date->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4">{{ $record->pet->pet_name ?? '-' }}</td>
                    <td class="px-6 py-4">
                        {{ $record->pet->client->name ?? '' }} {{ $record->pet->client->lastname ?? '' }}
                    </td>
                    <td class="px-6 py-4">{{ $record->vet->name ?? '-' }}</td>
                    <td class="px-6 py-4">{{ Str::limit($record->diagnosis, 40) }}</td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="{{ route('clinical_records.show', $record->id) }}"
                            class="font-medium text-blue-600 hover:underline">Ver</a>
                        @can('clinical_records.edit')
                        <a href="{{ route('clinical_records.edit', $record->id) }}"
                            class="font-medium text-yellow-600 hover:underline">Editar</a>
                        @endcan
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        No hay fichas clínicas registradas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection