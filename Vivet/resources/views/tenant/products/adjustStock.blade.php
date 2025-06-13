@extends('tenant.layouts.app')
@include('tenant.partials.colors')
@section('title', 'Ajustar Inventario')

@section('content')
<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Ajustar inventario: {{ $product->name }}</h1>
    @if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.adjustStock', $product) }}" method="POST" class="space-y-4">
        @csrf


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
            <label for="reason" class="block font-medium">Razón</label>
            <textarea name="reason" id="reason" rows="3" class="w-full border p-2 rounded" required>Venta/Baja/Ingreso</textarea>
        </div>

        <div class="flex items-center gap-2">
            <a style="background-color: var(--color-button-secondary);" class="bg-indigo-600 text-white px-5 py-2 rounded" href="{{ route('products.index') }}">← Volver a productos</a>

            <button style="background-color: var(--color-button-secondary);" type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Registrar movimiento</button>
        </div>
    </form>
</div>

@endsection