@extends('layouts.app')
@include('partials.colors')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Insumos</h1>
        @can('supplies.create')
            <a href="{{ route('supplies.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
                + Nuevo Insumo
            </a>
        @endcan
        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full table-auto border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Nombre</th>
                    <th class="p-2 border">Description</th>
                    <th class="p-2 border">Stock</th>
                    @can('supplies.edit')
                        <th class="p-2 border">Acciones</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @forelse ($supplies as $supply)
                    <tr>
                        <td class="p-2 border text-center">{{ $supply->name }}</td>
                        <td class="p-2 border text-center">{{ $supply->description }}</td>
                        <td class="p-2 border text-center">{{ $supply->stock }}</td>

                        @can('supplies.edit')
                            <td class="py-2 px-4 border-b space-x-2 flex justify-center items-center gap-4">

                                <a href="{{ route('products.edit', $supply) }}"
                                    class="text-blue-600 hover:underline flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16 3l5 5m0 0L10 19H5v-5L16 3z" />
                                    </svg>
                                    Editar
                                </a>
                                <form action="{{ route('products.destroy', $supply) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Eliminar
                                    </button>
                                </form>

                            </td>
                        @endcan
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">No hay productos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection