@extends('tenant.layouts.app')

{{-- @section('title', 'Editar Producto')
<div class="bg-red-100 text-red-800 p-4 rounded">
    <strong>¡Ups! Algo salió mal:</strong>
    <ul class="list-disc pl-5 mt-2">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
@endforeach
</ul>
</div> --}}

@section('content')
<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Editar Producto</h1>

    <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-medium">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="description" class="block font-medium">Descripción</label>
            <textarea name="description" id="description"
                class="w-full border p-2 rounded">{{ old('description', $product->description) }}</textarea>
        </div>

        <div>
            <label for="price" class="block font-medium">Precio</label>
            <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $product->price) }}"
                class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="stock" class="block font-medium">Stock</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                class="w-full border p-2 rounded" readonly>
        </div>

        <div id="toggleVaccines" class="flex items-center gap-2 ">
            <label for="is_active" class="inline-flex items-center mx-4">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" class="mr-2" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                ¿Activo?
            </label>
            <label for="is_vaccine" class="inline-flex items-center mx-4">
                <input type="hidden" name="is_vaccine" value="0">
                <input type="checkbox" name="is_vaccine" id="is_vaccine"  class="mr-2" value="1" {{ old('is_vaccine', $product->is_vaccine) ? 'checked' : '' }}>
                ¿Es una vacuna?
            </label>
        </div>

        <div id="vaccineinfo" class="mt-4 {{ old('is_vaccine', $product->is_vaccine) ? '' : 'hidden' }} space-y-4 border-t pt-4">
            <div>
                <label for="species" class="block font-medium">Especie dirigida</label>
                <input type="text" name="vaccine_species" id="species" class="w-full border p-2 rounded"
                    value="{{ old('vaccine_species', $vaccine->species ?? '') }}">
            </div>

            <div>
                <label for="validity_period" class="block font-medium">Tiempo de validez (días)</label>
                <input type="number" name="validity_period" id="validity_period"
                    value="{{ old('validity_period', $vaccine->validity_period ?? '') }}"
                    class="w-full border p-2 rounded">
            </div>
        </div>

        <div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Actualizar</button>
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const isVaccineCheckbox = document.getElementById('is_vaccine');
        const vaccineInfoSection = document.getElementById('vaccineinfo');

        function toggleVaccineFields() {
            if (isVaccineCheckbox.checked) {
                vaccineInfoSection.classList.remove('hidden');
            } else {
                vaccineInfoSection.classList.add('hidden');
            }
        }

        isVaccineCheckbox.addEventListener('change', toggleVaccineFields);
        toggleVaccineFields(); // para el estado inicial
    });
</script>
@endsection