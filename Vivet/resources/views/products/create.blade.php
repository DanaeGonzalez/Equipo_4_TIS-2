@extends('layouts.app')
@include('partials.colors')
@section('title', 'Crear Producto')

@section('content')
<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Nuevo Producto</h1>
    @if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
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
            <label for="price" class="block font-medium">Precio</label>
            <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}"
                class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="stock" class="block font-medium">Stock</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock') }}" class="w-full border p-2 rounded"
                required>

            <div>
                <label for="reason" class="block text-sm font-medium text-gray-900">Motivo</label>
                <input type="text" name="stock_reason" id="reason" class="mt-1 block w-full border p-2 rounded" value="Stock inicial" readonly>
            </div>
        </div>

        <div>
            <label for="is_active" class="inline-flex items-center">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" class="mr-2" value="1" {{ old('is_active') ? 'checked' : '' }}>
                ¿Activo?
            </label>
        </div>
        <input type="hidden" name="stock_reason" id="stock_reason_input" value="Stock inicial">
        <input type="hidden" name="movement_type" id="movement_type_input" value="Entrada">
        <div>
            <button style="background-color: var(--color-button-secondary);" type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Guardar</button>
        </div>

    </form>

</div>

@endsection