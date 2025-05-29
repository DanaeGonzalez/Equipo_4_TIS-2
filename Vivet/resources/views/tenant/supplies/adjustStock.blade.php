@extends('layouts.app')
@include('partials.colors')
@section('title', 'Ajustar Inventario')

@section('content')
<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Ajustar inventario: {{ $supply->name }}</h1>
    @if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('supplies.adjustStock', $supply) }}" method="POST" class="space-y-4">
        @csrf

        {{--<div>
            <label for="name" class="block font-medium">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name', $supply->name) }}" class="w-full border p-2 rounded" readonly>
</div>

<div>
    <label for="description" class="block font-medium">Descripción</label>
    <textarea readonly name="description" id="description" class="w-full border p-2 rounded">{{ old('description', $supply->description) }}</textarea>
</div>--}}

<div>
    <label for="movement_type" class="block font-medium">Tipo de movimiento</label>
    <select name="movement_type" id="movement_type" class="w-full border p-2 rounded" required>
        <option value="entrada">Entrada</option>
        <option value="salida">Salida</option>
    </select>
</div>

<div>
    <label for="quantity" class="block font-medium">Cantidad</label>
    <input type="number" name="quantity" id="quantity" class="w-full border p-2 rounded" min="1" required>
</div>

<div>
    <label for="unit_type" class="block font-medium">Unidad</label>
    <select name="unit_type" id="unit_type" class="w-full border p-2 rounded" required>
        <option value="unidades" {{ old('unit_type') == 'unidades' ? 'selected' : '' }}>Unidades</option>
        <option value="cajas">Cajas</option>
    </select>
    {{-- <small id="unitPreview" class="text-gray-600 block mt-1"></small> --}}
</div>

<div id="unitsPerBoxField" class="mt-2 hidden">
    <label for="units_per_box" class="block font-medium">Unidades por caja</label>
    <input type="number" name="units_per_box" id="units_per_box" value="{{ old('units_per_box') }}" class="w-full border p-2 rounded">
</div>
<div>
    <label for="reason" class="block font-medium">Razón</label>
    <textarea name="reason" id="reason" rows="3" class="w-full border p-2 rounded" required>Venta/Baja/Ingreso</textarea>
</div>

<div class="flex items-center gap-2">
    <a style="background-color: var(--color-button-secondary);" class="bg-indigo-600 text-white px-5 py-2 rounded" href="{{ route('supplies.index') }}">← Volver a insumos</a>

    <button style="background-color: var(--color-button-secondary);" type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Registrar movimiento</button>
</div>
</form>
</div>

<script>
    function toggleUnitsPerBox() {
        const unitSelect = document.getElementById('unit_type');
        const unitsPerBoxField = document.getElementById('unitsPerBoxField');

        if (unitSelect.value === 'cajas') {
            unitsPerBoxField.classList.remove('hidden');
        } else {
            unitsPerBoxField.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        toggleUnitsPerBox(); // Ejecutar al cargar
        document.getElementById('unit_type').addEventListener('change', toggleUnitsPerBox); // Ejecutar al cambiar
    });
</script>

@endsection