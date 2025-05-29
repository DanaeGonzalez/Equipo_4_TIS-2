@extends('layouts.app')
@include('partials.colors')

@section('title', 'Nuevo Insumos')
@section('content')
<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Nuevo Insumo</h1>
    @if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('supplies.store') }}" method="POST" class="space-y-4">
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

        {{--<div>
            <label for="price" class="block font-medium">Costo Total</label> la idea es que más adealante, se pueda calcular los ingresos y los gastos
            <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}"
                class="w-full border p-2 rounded" required>
        </div>--}}

        <div>
            <label for="stock" class="block font-medium">Stock</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock') }}" class="w-full border p-2 rounded"
                required>
            <label for="unit_type" class="block font-medium">Unidad</label>
            <select name="unit_type" id="unit_type" class="w-full border rounded p-2" required onchange="toggleUnitsPerBox()">
                <option value="">Seleccione</option>
                <option value="unidades" {{ old('unit_type') == 'unidades' ? 'selected' : '' }}>Unidades</option>
                <option value="cajas" {{ old('unit_type') == 'cajas' ? 'selected' : '' }}>Cajas</option>
            </select>

            <div id="unitsPerBoxField" class="mt-2 hidden">
                <label for="units_per_box" class="block font-medium">Unidades por caja</label>
                <input type="number" name="units_per_box" id="units_per_box" value="{{ old('units_per_box') }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label for="reason" class="block font-medium">Motivo</label>
                <input type="text" name="stock_reason" id="reason" class="mt-1 block w-full border p-2 rounded" value="Stock inicial" readonly>
            </div>
        </div>

        <input type="hidden" name="stock_reason" id="stock_reason_input" value="Stock inicial">
        <input type="hidden" name="movement_type" id="movement_type_input" value="Entrada">
        <div class="flex items-center gap-2">
            <a style="background-color: var(--color-button-secondary);" class="bg-indigo-600 text-white px-5 py-2 rounded" href="{{ route('supplies.index') }}">← Volver a insumos</a>

            <button style="background-color: var(--color-button-secondary);" type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Guardar</button>
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

    // Ejecutar al cargar
    document.addEventListener('DOMContentLoaded', toggleUnitsPerBox);
</script>

@endsection