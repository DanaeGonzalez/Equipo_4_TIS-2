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
                        <td class="py-2 px-4 border-b space-x-2">
                            <a href="{{ route('roles.edit', $role) }}" class="text-blue-600 hover:underline">Editar</a>
                            <form action="{{ route('roles.destroy', $role) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este rol?')" class="text-red-600 hover:underline">
                                    Eliminar
                                </button>
                            </form>
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
