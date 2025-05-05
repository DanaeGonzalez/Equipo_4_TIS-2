@extends('layouts.app')

@section('title', 'Editar permisos')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Permisos para el rol: {{ $role->name }}</h1>

    <form action="{{ route('roles.updatePermissions', $role) }}" method="POST">
        @csrf

        <div class="space-y-2">
            @foreach ($permissions as $permission)
                <div class="flex items-center">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                        {{ $role->permissions->contains($permission) ? 'checked' : '' }}
                        class="mr-2">
                    <label>{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded">Guardar cambios</button>
    </form>
</div>
@endsection
