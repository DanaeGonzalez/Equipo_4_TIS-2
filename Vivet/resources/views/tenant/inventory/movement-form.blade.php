<!-- resources/views/inventory/movement-form.blade.php -->
 @extends('layouts.app')
@include('partials.colors')

@section('content')
<form method="POST" action="{{ route('inventory.store') }}" class="space-y-6">
    @csrf

    <!-- Tipo de ítem -->
    <div>
        <label for="item_type" class="block mb-2 font-medium">Tipo de ítem</label>
        <select name="item_type" id="item_type" required class="w-full p-2 border rounded">
            <option value="App\Models\Product">Producto</option>
            <option value="App\Models\Supply">Insumo</option>
        </select>
    </div>

    <!-- Selección dinámica del ítem -->
    <div>
        <label for="item_id" class="block mb-2 font-medium">Ítem</label>
        <select name="item_id" id="item_id" required class="w-full p-2 border rounded">
            @foreach($items as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Tipo de movimiento -->
    <div>
        <label for="movement_type" class="block mb-2 font-medium">Movimiento</label>
        <select name="movement_type" id="movement_type" required class="w-full p-2 border rounded">
            <option value="entrada">Entrada</option>
            <option value="salida">Salida</option>
        </select>
    </div>

    <!-- ¿En caja o unidad? -->
    <div id="unit_type_wrapper">
        <label class="block mb-2 font-medium">Tipo de unidad</label>
        <select name="unit_type" id="unit_type" required class="w-full p-2 border rounded">
            <option value="unidad">Unidad</option>
            <option value="caja">Caja</option>
        </select>
    </div>

    <!-- Cantidad -->
    <div>
        <label for="quantity" class="block mb-2 font-medium">Cantidad</label>
        <input type="number" name="quantity" id="quantity" required class="w-full p-2 border rounded">
    </div>

    <!-- Unidades por caja -->
    <div id="units_per_box_wrapper" style="display:none;">
        <label for="units_per_box" class="block mb-2 font-medium">Unidades por caja</label>
        <input type="number" name="units_per_box" id="units_per_box" class="w-full p-2 border rounded">
    </div>

    <!-- Motivo -->
    <div>
        <label for="reason" class="block mb-2 font-medium">Motivo</label>
        <textarea name="reason" id="reason" class="w-full p-2 border rounded"></textarea>
    </div>

    <!-- Botón -->
    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Registrar</button>
</form>

<script>
    document.getElementById('unit_type').addEventListener('change', function () {
        const boxInput = document.getElementById('units_per_box_wrapper');
        if (this.value === 'caja') {
            boxInput.style.display = 'block';
        } else {
            boxInput.style.display = 'none';
        }
    });
</script>
@endsection