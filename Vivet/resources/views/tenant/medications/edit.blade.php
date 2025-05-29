@extends('tenant.layouts.app')
@include('tenant.partials.colors')

@section('title', 'Editar Medicamento')

@section('content')
<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Editar Medicamento</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('medications.update', $medication) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-medium">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name', $medication->name) }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="description" class="block font-medium">Descripción</label>
            <textarea name="description" id="description" class="w-full border p-2 rounded">{{ old('description', $medication->description) }}</textarea>
        </div>

        <div>
            <label for="dosage_instructions" class="block font-medium">Instrucciones de Dosis</label>
            <textarea name="dosage_instructions" id="dosage_instructions" class="w-full border p-2 rounded">{{ old('dosage_instructions', $medication->dosage_instructions) }}</textarea>
        </div>

        <div class="flex items-center gap-2">
            <a style="background-color: var(--color-button-secondary);" href="{{ route('medications.index') }}"
               class="bg-indigo-600 text-white px-5 py-2 rounded">← Volver</a>

            <button style="background-color: var(--color-button-secondary);" type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded">Actualizar</button>
        </div>
    </form>
</div>
@endsection
