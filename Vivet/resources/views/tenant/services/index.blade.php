@extends('layouts.app')

@section('title', 'Lista de Servicios')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Servicios</h1>

        @can('services.create')
            <a href="{{ route('services.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
                + Nuevo Servicio
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
                    <th class="p-2 border">Duración estimada</th>
                    <th class="p-2 border">Precio</th>
                    <th class="p-2 border">Icono</th>
                    @if ($role === 'Administrador')
                        <th class="p-2 border">Activo</th>
                    @endif
                    @can('services.edit')
                    <th class="p-2 border">Acciones</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @forelse ($services as $service)
                    <tr>
                        <td class="p-2 border text-center">{{ $service->name }}</td>
                        <td class="p-2 border text-center">{{ $service->estimated_duration }} min</td>
                        <td class="p-2 border text-center">${{ number_format($service->price, 0, ',', '.') }}</td>
                        <td class="p-2 border"><img src="{{ asset($service->icon) }}" alt="Ícono del servicio"
                                class="w-16 h-16 object-cover rounded mx-auto">
                        </td>

                        @if ($role === 'Administrador')
                            <td class="p-2 border text-center">
                                @if($service->is_active)
                                    <span class="text-green-600 font-bold">Sí</span>
                                @else
                                    <span class="text-red-600 font-bold">No</span>
                                @endif
                                {{--{{ $service->is_active }}--}}

                            </td>
                        @endif
                        @can('services.edit')
                            <td class="p-2 border">
                                <a href="{{ route('services.edit', $service) }}"
                                    class="text-blue-600 hover:underline flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16 3l5 5m0 0L10 19H5v-5L16 3z" />
                                    </svg>
                                    Editar
                                </a>
                        @endcan
                            @can('services.destroy')
                                <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline">
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
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">No hay servicios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection