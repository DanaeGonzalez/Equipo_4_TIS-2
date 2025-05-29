@extends('tenant.layouts.app')
@include('tenant.partials.colors')

@section('title', 'Nueva Ficha Clínica')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Nueva Ficha Clínica</h1>

    @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clinical_records.store') }}" method="POST">
        @csrf

        {{-- Mascota --}}
        <div class="mb-4">
            <label for="pet_id" class="block mb-2 text-sm font-medium text-gray-700">Mascota</label>
            <select name="pet_id" id="pet_id" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-full p-2.5">
                <option value="">Selecciona una mascota</option>
                @foreach ($pets as $pet)
                    <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>
                        {{ $pet->pet_name }} ({{ $pet->species }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Fecha --}}
        <div class="mb-4">
            <label for="date" class="block mb-2 text-sm font-medium text-gray-700">Fecha de atención</label>
            <input type="datetime-local" id="date" name="date" value="{{ old('date') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-full p-2.5"
                required>
        </div>

        {{-- Peso y Temperatura --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="weight" class="block mb-2 text-sm font-medium text-gray-700">Peso (kg)</label>
                <input type="number" step="0.01" id="weight" name="weight" value="{{ old('weight') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-full p-2.5">
            </div>
            <div>
                <label for="temperature" class="block mb-2 text-sm font-medium text-gray-700">Temperatura (°C)</label>
                <input type="number" step="0.1" id="temperature" name="temperature" value="{{ old('temperature') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-full p-2.5">
            </div>
        </div>

        {{-- Síntomas --}}
        <div class="mb-4">
            <label for="symptoms" class="block mb-2 text-sm font-medium text-gray-700">Síntomas</label>
            <textarea id="symptoms" name="symptoms" rows="3"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-full p-2.5"
                required>{{ old('symptoms') }}</textarea>
        </div>

        {{-- Diagnóstico --}}
        <div class="mb-4">
            <label for="diagnosis" class="block mb-2 text-sm font-medium text-gray-700">Diagnóstico</label>
            <textarea id="diagnosis" name="diagnosis" rows="3"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-full p-2.5">{{ old('diagnosis') }}</textarea>
        </div>

        {{-- Tratamiento --}}
        <div class="mb-4">
            <label for="treatment" class="block mb-2 text-sm font-medium text-gray-700">Tratamiento</label>
            <textarea id="treatment" name="treatment" rows="3"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-full p-2.5">{{ old('treatment') }}</textarea>
        </div>

        {{-- Notas --}}
        <div class="mb-6">
            <label for="notes" class="block mb-2 text-sm font-medium text-gray-700">Notas adicionales</label>
            <textarea id="notes" name="notes" rows="2"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-full p-2.5">{{ old('notes') }}</textarea>
        </div>

        {{-- Botones --}}
        <div class="flex justify-between">
            <a href="{{ route('clinical_records.index') }}"
               class="text-sm text-gray-600 hover:underline">← Cancelar</a>

            <button type="submit"
                class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Guardar Ficha
            </button>
        </div>
    </form>
</div>
@endsection
