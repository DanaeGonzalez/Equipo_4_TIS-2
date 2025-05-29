@extends('layouts.app')

@section('title', 'Editar permisos')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Permisos para el rol: {{ $role->name }}</h1>

    <form action="{{ route('roles.permissions.update', $role) }}" method="POST">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="mb-4 p-2 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <select name="entity" class="p-2 border rounded">
                <option value="">-- Filtrar por vista --</option>
                @foreach ($entities as $entity)
                <option value="{{ $entity }}" {{ request('entity') == $entity ? 'selected' : '' }}>
                    {{ ucfirst($entity) }}
                </option>
                @endforeach
            </select>

            <select name="action" class="p-2 border rounded">
                <option value="">-- Tipo de permiso --</option>
                @foreach ($actions as $action)
                <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                    {{ ucfirst($action) }}
                </option>
                @endforeach
            </select>
            
            <button type="submit" class="w-full col-span-1 md:col-span-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Filtrar
            </button>
            <a href="{{ route('roles.permissions.edit') }}" class="w-full block text-center px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Restablecer filtros</a>
            
        </form> --}}

        <div class="space-y-4">
    @foreach ($grouped as $group => $permissions)
        <div class="border rounded p-4">
            <h2 class="text-lg font-semibold mb-2">{{ $group }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                @foreach ($permissions as $permission)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                            {{ $role->permissions->contains($permission) ? 'checked' : '' }}
                            class="text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <span>{{ $permission->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach
</div>


        <button type="submit" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            Guardar cambios
        </button>
    </form>
</div>
@endsection
