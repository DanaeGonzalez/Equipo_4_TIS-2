{{-- resources/views/roles/create.blade.php --}}
@extends('tenant.layouts.app')

@section('title', 'Crear Rol')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">Crear nuevo Rol</h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-600 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('roles.store') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre del rol</label>
                <input type="text" name="name" id="name" class="w-full mt-1 border-gray-300 rounded shadow-sm" value="{{ old('name') }}" required>
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" name="is_active" id="is_active" class="mr-2" {{ old('is_active') ? 'checked' : '' }}>
                <label for="is_active" class="text-sm text-gray-700">¿Activo?</label>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('roles.index') }}" class="text-indigo-600 hover:underline">Volver</a>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Guardar Rol
                </button>
            </div>
        </form>
    </div>
@endsection
