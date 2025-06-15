@extends('tenant.layouts.app')
@include('tenant.partials.colors')

@section('title', 'Editar Prescripción')

@section('content')
<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Editar Prescripción</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('prescriptions.update', $prescription) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="medication_id" class="block font-medium">Medicamento</label>
            <select name="medication_id" id="medication_id" class="w-full border p-2 rounded" required>
                <option value="">Seleccione un medicamento</option>
                @foreach ($medications as $medication)
                    <option value="{{ $medication->id }}" {{ old('medication_id', $prescription->medication_id) == $medication->id ? 'selected' : '' }}>
                        {{ $medication->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="dosage" class="block font-medium">Dosis</label>
            <input type="text" name="dosage" id="dosage" value="{{ old('dosage', $prescription->dosage) }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="duration" class="block font-medium">Duración</label>
            <input type="text" name="duration" id="duration" value="{{ old('duration', $prescription->duration) }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="notes" class="block font-medium">Notas adicionales</label>
            <textarea name="notes" id="notes" class="w-full border p-2 rounded">{{ old('notes', $prescription->notes) }}</textarea>
        </div>

        <div class="flex items-center gap-2">
            <a style="background-color: var(--color-button-secondary);"
               href="{{ route('clinical_records.edit', $prescription->clinical_record_id) }}"
               class="bg-indigo-600 text-white px-5 py-2 rounded">← Volver a la ficha</a>

            <button style="background-color: var(--color-button-secondary);" type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded">Actualizar</button>
        </div>
    </form>
</div>
@endsection
