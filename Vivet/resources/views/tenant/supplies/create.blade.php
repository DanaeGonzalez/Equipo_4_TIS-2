@extends('tenant.layouts.app')
@include('tenant.partials.colors')

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
    <input type="number" name="stock" id="stock" value="{{ old('stock') }}" step="1" min="0" class="w-full border p-2 rounded"
        required>
    <label for="unit_type" class="block font-medium">Unidad</label>
    <select name="unit_type" id="unit_type" class="w-full border rounded p-2" required onchange="toggleUnitsPerBox()">
        <option value="">Seleccione</option>
        <option value="unidades" {{ old('unit_type') == 'unidades' ? 'selected' : '' }}>Unidades</option>
        <option value="cajas" {{ old('unit_type') == 'cajas' ? 'selected' : '' }}>Cajas</option>
    </select>

    <div id="unitsPerBoxField" class="mt-2 hidden">
        <label for="units_per_box" class="block font-medium">Unidades por caja</label>
        <input type="number" name="units_per_box" id="units_per_box" value="{{ old('units_per_box') }}" step="1" min="0" class="w-full border p-2 rounded">
    </div>

    <div>
        <label for="reason" class="block font-medium">Motivo</label>
        <input type="text" name="stock_reason" id="reason" class="mt-1 block w-full border p-2 rounded" value="Stock inicial" readonly>
    </div>
</div>

<div>
    <label for="supplier_id" class="block font-medium">Proveedor</label>
    <select name="supplier_id" id="supplier_id" class="w-full border p-2 rounded" required>
        <option value="">-- Selecciona un proveedor --</option>
        @foreach ($suppliers as $supplier)
        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
            {{ $supplier->name }}
        </option>
        @endforeach
    </select>
    <button style="background-color: var(--color-button-secondary);" type="button" onclick="openSupplierModal()"
        class="mt-2 bg-green-500 text-white px-3 rounded">Agregar Proveedor</button>
</div>

<div>
    <label for="unit_cost" class="block font-medium">Costo Unitario</label>
    <input type="number" name="unit_cost" id="unit_cost" value="{{ old('unit_cost') }}" step="1" min="0"
        class="w-full border p-2 rounded" required>
</div>


<input type="hidden" name="stock_reason" id="stock_reason_input" value="Stock inicial">
<input type="hidden" name="movement_type" id="movement_type_input" value="Entrada">
<div class="flex items-center gap-2">
    <a style="background-color: var(--color-button-secondary);" class="bg-indigo-600 text-white px-5 py-2 rounded" href="{{ route('supplies.index') }}">← Volver a insumos</a>

    <button style="background-color: var(--color-button-secondary);" type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Guardar</button>
</div>

</form>

<div id="SupplierModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
    <div class="bg-white rounded p-6 w-full max-w-md space-y-4">
        <h3 class="text-xl font-bold">Nuevo Proveedor</h3>
        <form action="{{ route('suppliers.store.from.supply') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nombre de la Empresa" required class="w-full border rounded p-2 my-2">
            <input type="text" name="contact_name" placeholder="Nombre del Vendedor" class="w-full border rounded p-2 my-2">
            <input type="email" name="email" placeholder="Correo" class="w-full border rounded p-2 my-2">
            <input type="text" name="phone" placeholder="Teléfono" class="w-full border rounded p-2 my-2">
            <input type="text" name="address" placeholder="Dirección" class="w-full border rounded p-2 my-2">

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeSupplierModal()"
                    class="bg-gray-400 px-3 py-1 rounded text-white">Cancelar</button>
                <button style="background-color: var(--color-button-secondary);" type="submit"
                    class="px-3 py-1 rounded text-white">Guardar</button>
            </div>
        </form>

    </div>
</div>

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

    function openSupplierModal() {
        document.getElementById('SupplierModal').classList.remove('hidden');
    }

    function closeSupplierModal() {
        document.getElementById('SupplierModal').classList.add('hidden');
    }
</script>

@endsection