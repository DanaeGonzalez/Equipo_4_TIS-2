@extends('tenant.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Listado de Mascotas</h2>

        @can('pets.create')
        <a href="{{ route('pets.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            Nueva Mascota
        </a>
        @endcan
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse">
            <thead class="bg-gray-200 text-left">
                <tr>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Especie</th>
                    <th class="px-4 py-2">Raza</th>
                    <th class="px-4 py-2">Color</th>
                    <th class="px-4 py-2">Sexo</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Dueño</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pets as $pet)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $pet->pet_name }}</td>
                        <td class="px-4 py-2">{{ $pet->species }}</td>
                        <td class="px-4 py-2">{{ $pet->breed ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $pet->color }}</td>
                        <td class="px-4 py-2">{{ $pet->sex }}</td>
                        <td class="px-4 py-2">{{ $pet->status }}</td>
                        <td class="px-4 py-2">{{ $pet->client->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 space-x-2 flex">
                            @can('pets.edit')
                            <a href="{{ route('pets.edit', $pet->id) }}"
                               class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 text-sm">
                                Editar
                            </a>
                            @endcan

                            @can('pets.destroy')
                            <form action="{{ route('pets.destroy', $pet->id) }}" method="POST"
                                  onsubmit="return confirm('¿Marcar como fallecida esta mascota?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-sm">
                                    Marcar fallecida
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-4 text-center text-gray-500">No hay mascotas registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
