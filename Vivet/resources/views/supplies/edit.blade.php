@extends('layouts.app')
@include('partials.colors')
@section('title', 'Editar Insumo')

@section('content')
<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Editar Insumo</h1>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('supplies.update', $supply) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-medium">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name', $supply->name) }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="description" class="block font-medium">Descripción</label>
            <textarea name="description" id="description" class="w-full border p-2 rounded">{{ old('description', $supply->description) }}</textarea>
        </div>

        <div>
            <label for="stock" class="block font-medium">Stock (en unidades)</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $supply->stock) }}" class="w-full border p-2 rounded" disabled>
        </div>

        <div>
            <label for="unit_type" class="block font-medium">Unidad</label>
            <input name="unit_type" id="unit_type" value="{{ old('unit_type', $supply->unit_type) }}" class="w-full border p-2 rounded" disabled>
        </div>

        <div id="unitsPerBoxField" class="{{ old('unit', $supply->unit) == 'cajas' ? '' : 'hidden' }}">
            <label for="units_per_box" class="block font-medium mt-2">Unidades por caja</label>
            <input type="number" name="units_per_box" id="units_per_box" value="{{ old('units_per_box', $supply->units_per_box) }}" class="w-full border p-2 rounded">
        </div>
        
        <div>
            <label for="is_active" class="inline-flex items-center">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" class="mr-2" value="1" {{ old('is_active', $supply->is_active) ? 'checked' : ''}}>
                ¿Activo?
            </label>
        </div>

        <div class="flex items-center gap-2">
            <a style="background-color: var(--color-button-secondary);" class="bg-indigo-600 text-white px-5 py-2 rounded" href="{{ route('supplies.index') }}">← Volver a insumos</a>

            <button style="background-color: var(--color-button-secondary);" type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Actualizar</button>
        </div>
    </form>
</div>

<script>
    function toggleUnitsPerBox() {
        const unitSelect = document.getElementById('unit');
        const field = document.getElementById('unitsPerBoxField');
        field.classList.toggle('hidden', unitSelect.value !== 'cajas');
    }

    document.addEventListener('DOMContentLoaded', toggleUnitsPerBox);
</script>
@endsection