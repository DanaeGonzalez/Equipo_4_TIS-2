@extends('layouts.app')

@section('title', 'Permisos')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Lista de permisos</h1>

    <a href="{{ route('permissions.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">Nuevo Permiso</a>

    <ul class="mt-4 space-y-2">
        @foreach($permissions as $permission)
            <li class="flex justify-between items-center border p-2">
                <span>{{ $permission->name }}</span>
                <div>
                    <a href="{{ route('permissions.edit', $permission) }}" class="text-blue-500 mr-2">Editar</a>
                    <form action="{{ route('permissions.destroy', $permission) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500" onclick="return confirm('¿Eliminar permiso?')">Eliminar</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
