@extends('tenant.layouts.app')
@include('tenant.partials.colors')

@section('title', 'Clientes')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <div class="flex items-center justify-between mb-4 w-full flex-wrap gap-2">
        {{-- Buscador opcional (puedes conectar al backend luego) --}}
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" fill="none" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" id="table-search" placeholder="Buscar cliente..."
                class="block ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" />
        </div>

        {{-- Botón Crear --}}
        @can('clients.create')
        <a href="{{ route('clients.create') }}"
            class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            + Crear Cliente
        </a>
        @endcan
    </div>

    @if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    {{-- Tabla --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Nombre</th>
                    <th class="px-6 py-3">RUT</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Teléfono</th>
                    <th class="px-6 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $client->name }} {{ $client->lastname }}
                    </td>
                    <td class="px-6 py-4">{{ $client->client_run }}</td>
                    <td class="px-6 py-4">{{ $client->email }}</td>
                    <td class="px-6 py-4">{{ $client->phone ?? '-' }}</td>
                    <td class="px-6 py-4 text-center space-x-2">
                        @can('clients.edit')
                        <a href="{{ route('clients.edit', $client->id) }}"
                            class="font-medium text-yellow-600 hover:underline">Editar</a>
                        @endcan
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        No hay clientes registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $clients->links() }}
    </div>
</div>
@endsection