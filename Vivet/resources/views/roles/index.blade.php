@extends('layouts.app')

@section('title', 'Listado de Roles')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Listado de Roles</h1>
            <a href="{{ route('roles.create') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded">
                Crear Rol
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 text-green-600 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 text-red-600 font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded shadow">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>

                        <th class="py-2 px-4 border-b">Nombre</th>
                        <th class="py-2 px-4 border-b">Activo</th>
                        <th class="py-2 px-4 border-b">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                        <tr class="text-center">

                            <td class="py-2 px-4 border-b">{{ $role->name }}</td>
                            <td class="py-2 px-4 border-b">
                                @if($role->is_active)
                                    <span class="text-green-600 font-semibold">Sí</span>
                                @else
                                    <span class="text-red-600 font-semibold">No</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b space-x-2 flex justify-center items-center gap-4">
                                <a href="{{ route('roles.edit', $role) }}"
                                    class="text-blue-600 hover:underline flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16 3l5 5m0 0L10 19H5v-5L16 3z" />
                                    </svg>
                                    Editar
                                </a>
                                <a href="{{ route('roles.permissions.edit', $role) }}"
                                    class="text-indigo-600 hover:underline flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    Permisos
                                </a>
                                @unless(in_array(strtolower($role->name), ['administrador', 'superadmin']))
                                    <form action="{{ route('roles.destroy', $role) }}" method="POST"
                                        class="inline flex items-center gap-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este rol?')"
                                            class="text-red-600 hover:underline flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Eliminar
                                        </button>
                                    </form>
                                @endunless
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">No hay roles registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection