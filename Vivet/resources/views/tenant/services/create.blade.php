@extends('tenant.layouts.app')

@section('title', 'Crear Servicio')

{{-- @if ($errors->any())
<div class="bg-red-100 text-red-800 p-4 rounded">
    <strong>¡Ups! Algo salió mal:</strong>
    <ul class="list-disc pl-5 mt-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif --}}

@section('content')
    <div class="max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-4">Nuevo Servicio</h1>

        <form action="{{ route('services.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">

            @csrf

            <div>
                <label for="name" class="block font-medium">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full border p-2 rounded"
                    required>
            </div>

            <div>
                <label for="description" class="block font-medium">Descripción</label>
                <textarea name="description" id="description"
                    class="w-full border p-2 rounded">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="estimated_duration" class="block font-medium">Duración Estimada (minutos)</label>
                <input type="number" name="estimated_duration" id="estimated_duration"
                    value="{{ old('estimated_duration') }}" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label for="price" class="block font-medium">Precio</label>
                <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}"
                    class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label for="is_active" class="inline-flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" class="mr-2" {{ old('is_active') ? 'checked' : '' }}>
                    ¿Activo?
                </label>
            </div>

            <div>
                <label for="icon">Ícono (opcional)</label>
                <input type="file" class="bg-indigo-600 text-white px-4 py-2 rounded" name="icon" accept="image/*">
            </div>

            <div>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Guardar</button>
            </div>
        </form>
    </div>
@endsection