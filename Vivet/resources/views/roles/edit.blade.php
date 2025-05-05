{{-- resources/views/roles/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Editar Rol')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Editar Rol</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('roles.update', $role) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-semibold mb-1">Nombre del Rol</label>
                <input type="text" id="name" name="name" value="{{ old('name', $role->name) }}"
                       class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" id="is_active" name="is_active" {{ $role->is_active ? 'checked' : '' }}
                       class="mr-2">
                <label for="is_active" class="text-sm">Activo</label>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('roles.index') }}" class="text-gray-600 hover:underline">Cancelar</a>
                <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Actualizar Rol
                </button>
            </div>
        </form>
    </div>
@endsection
