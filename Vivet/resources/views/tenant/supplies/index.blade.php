@extends('layouts.app')
@include('partials.colors')

@section('title', 'Lista de Insumos')
@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Insumos</h1>
        @can('supplies.create')
        <a style="background-color: var(--color-button-secondary);" href="{{ route('supplies.create') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
            + Nuevo Insumo
        </a>
        @endcan
        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <form method="GET" action="{{ route('supplies.index') }}" class="mb-4 flex gap-2 items-center">
            <div class="flex-1">
                <input type="text" name="search" list="supplySuggestions" value="{{ request('search') }}"
                    placeholder="Buscar insumo por nombre..." class="border border-gray-300 px-3 py-2 rounded w-full" />
                <datalist id="supplySuggestions">
                    @foreach ($supplies as $supply)
                        <option value="{{ $supply->name }}"></option>
                    @endforeach
                </datalist>
            </div>

            <button type="submit" style="background-color: var(--color-button-secondary);"
                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 whitespace-nowrap">
                Buscar
            </button>

            <a href="{{ route('supplies.index') }}"
                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 text-center whitespace-nowrap">
                Restablecer
            </a>
        </form>


        {{--<form method="GET" action="{{ route('supplies.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <select name="entity" class="p-2 border rounded">
                <option value="">-- Filtrar por insumo --</option>
                @foreach ($supplies as $supply)
                <option value="{{ $supply }}" {{ request('supply')==$supply ? 'selected' : '' }}>
                    {{ $supply->name }}
                </option>
                @endforeach
            </select>

            <button style="background-color: var(--color-button-secondary);" type="submit"
                class="w-full col-span-1 md:col-span-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Filtrar
            </button>
            <a href="{{ route('supplies.index') }}"
                class="w-full block text-center px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Restablecer
                filtros</a>


        </form>--}}

        <table class="w-full table-auto border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Nombre</th>
                    <th class="p-2 border">Descripción</th>
                    <th class="p-2 border">Stock</th>
                    <th class="p-2 border">Disponible</th>
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
                        <td class="p-2 border text-center">@if($supply->is_active)
                            <span class="text-green-600 font-bold">Sí</span>
                        @else
                                <span class="text-red-600 font-bold">No</span>
                            @endif
                        </td>

                        @can('supplies.edit')
                        <td class="border"> {{-- Al td no puedo dar más que borde, si no, queda desordenado--}}
                            <div class="flex py-2 px-4 flex justify-center items-center gap-4"> {{-- Aquí si puedo--}}
                                <a href="{{ route('supplies.edit', $supply) }}"
                                    class="text-blue-600 hover:underline flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16 3l5 5m0 0L10 19H5v-5L16 3z" />
                                    </svg>
                                    Editar
                                </a>
                                <a href="{{ route('supplies.adjustStockForm', $supply) }}"
                                    class="text-blue-600 hover:underline flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                    </svg>
                                    Stock
                                </a>
                                <a href="{{ route('supplies.movements', $supply) }}"
                                    class="text-blue-600 hover:underline flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V13.5Zm0 2.25h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V18Zm2.498-6.75h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V13.5Zm0 2.25h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V18Zm2.504-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5Zm0 2.25h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V18Zm2.498-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5ZM8.25 6h7.5v2.25h-7.5V6ZM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0 0 12 2.25Z" />
                                    </svg>
                                    Movimientos
                                </a>

                                <form action="{{ route('supplies.destroy', $supply) }}" method="POST"
                                    class="flex items-center gap-1"> {{--Ojo--}}
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline flex items-center gap-1 mt-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Eliminar
                                    </button>
                                </form>

                            </div>
                        </td>
                        @endcan
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">No hay insumos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection