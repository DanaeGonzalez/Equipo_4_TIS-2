@extends('tenant.layouts.app')
@include('tenant.partials.colors')

@section('title', 'Nuevo Medicamento')

@section('content')
<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Nuevo Medicamento</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('medications.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-medium">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label for="description" class="block font-medium">Descripción</label>
            <textarea name="description" id="description" class="w-full border p-2 rounded">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="dosage_instructions" class="block font-medium">Instrucciones de Dosis</label>
            <textarea name="dosage_instructions" id="dosage_instructions" class="w-full border p-2 rounded">{{ old('dosage_instructions') }}</textarea>
        </div>

        <div>
            <button style="background-color: var(--color-button-secondary);" type="submit"
                class="bg-indigo-600 text-white px-4 py-2 rounded">Guardar</button>
        </div>
    </form>
</div>
@endsection
