@extends('tenant.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Listado de Clientes</h2>
        @can('clients.create')
            <a href="{{ route('clients.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Crear Cliente
            </a>
        @endcan
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white shadow-md rounded border">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">RUT</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Teléfono</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $client->name }} {{ $client->lastname }}</td>
                    <td class="px-4 py-2">{{ $client->client_run }}</td>
                    <td class="px-4 py-2">{{ $client->email }}</td>
                    <td class="px-4 py-2">{{ $client->phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $clients->links() }}
    </div>
</div>
@endsection
