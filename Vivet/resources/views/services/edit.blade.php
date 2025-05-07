@extends('layouts.app')

@section('title', 'Editar Servicio')

@section('content')
<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Editar Servicio</h1>

    <form action="{{ route('services.update', $service) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-medium">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="description" class="block font-medium">Descripción</label>
            <textarea name="description" id="description" class="w-full border p-2 rounded">{{ old('description', $service->description) }}</textarea>
        </div>

        <div>
            <label for="estimated_duration" class="block font-medium">Duración Estimada (minutos)</label>
            <input type="number" name="estimated_duration" id="estimated_duration" value="{{ old('estimated_duration', $service->estimated_duration) }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="price" class="block font-medium">Precio</label>
            <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $service->price) }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="icon" class="block font-medium">Icono</label>
            <input type="text" name="icon" id="icon" value="{{ old('icon', $service->icon) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Actualizar</button>
        </div>
    </form>
</div>
@endsection
