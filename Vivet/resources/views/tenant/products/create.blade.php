@extends('tenant.layouts.app')
@include('tenant.partials.colors')
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

        <div> {{-- Selector para elegir el tipo de categoría que tienen los productos (enum)--}}
            <label class="block font-semibold">Tipo de Producto</label>
            <select id="category" name="category" class="w-full border-gray-300 rounded">
                <option value="">-- Seleccionar Categoría --</option>
                <option value="Comida" {{ request('category') == 'Comida' ? 'selected' : '' }}>Comida</option>
                <option value="Vacunas" {{ request('category') == 'Vacunas' ? 'selected' : '' }}>Vacuna</option>
                <option value="Medicamentos" {{ request('category') == 'Medicamentos' ? 'selected' : '' }}>Medicamento</option>
                <option value="Accesorios" {{ request('category') == 'Accesorios' ? 'selected' : '' }}>Accesorio</option>

            </select>

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
                    <input type="text" name="stock_reason" id="reason" class="mt-1 block w-full border p-2 rounded"
                        value="Stock inicial" readonly>
                </div>
            </div>

            <div id="toggleVaccines" class="flex items-center gap-2">
                <label for="is_active" class="inline-flex items-center mx-4">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" class="mr-2" value="1" {{ old('is_active') ? 'checked' : '' }}>
                    ¿Activo?
                </label>

                {{--<label for="is_vaccine" class="inline-flex items-center mx-4">
                    <input type="hidden" name="is_vaccine" value="0">
                    <input type="checkbox" name="is_vaccine" id="is_vaccine" class="mr-2" value="1" {{ old('is_vaccine')
                        ? 'checked' : '' }}>
                ¿Es una vacuna?
                </label>--}}
            </div>

            <div id="vaccineinfo" class="mt-4 hidden space-y-4 border-t pt-4">
                <div>
                    <label for="species" class="block font-medium">Especie dirigida</label>
                    <input type="text" name="vaccine_species" id="species" class="w-full border p-2 rounded"
                        value="{{ old('vaccine_species') }}">
                </div>

                <div>
                    <label for="validity_period" class="block font-medium">Tiempo de validez (días)</label>
                    <input type="number" name="validity_period" id="validity_period" value="{{ old('validity_period') }}"
                        class="w-full border p-2 rounded">
                </div>
            </div>

            <div id=medicationinfo class="mt-4 hidden space-y-4 border-t pt-4">
                <div>
                    <label for="dosage_instructions" class="block font-medium">Instrucciones de Dosis</label>
                    <textarea name="dosage_instructions" id="dosage_instructions"
                        class="w-full border p-2 rounded">{{ old('dosage_instructions') }}</textarea>
                </div>

            </div>

            <input type="hidden" name="stock_reason" id="stock_reason_input" value="Stock inicial">
            <input type="hidden" name="movement_type" id="movement_type_input" value="Entrada">
            <div>
                <button style="background-color: var(--color-button-secondary);" type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded">Guardar</button>
            </div>

    </form>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category');
        const vaccineInfoSection = document.getElementById('vaccineinfo');
        const medicationInfoSection = document.getElementById('medicationinfo');

        function toggleCategoryFields() {
            const selectedCategory = categorySelect.value;

            if (selectedCategory === 'Vacunas') {
                vaccineInfoSection.classList.remove('hidden');
                medicationInfoSection.classList.add('hidden');
            } else if (selectedCategory === 'Medicamentos') {
                vaccineInfoSection.classList.add('hidden');
                medicationInfoSection.classList.remove('hidden');
            } else {
                vaccineInfoSection.classList.add('hidden');
                medicationInfoSection.classList.add('hidden');
            }
        }

        categorySelect.addEventListener('change', toggleCategoryFields);
        toggleCategoryFields();
    });
</script>

@endsection