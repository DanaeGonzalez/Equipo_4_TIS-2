@extends('tenant.layouts.app')
@include('tenant.partials.colors')

@section('title', 'Ficha Clínica')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Ficha Clínica</h1>
            <a href="{{ route('clinical_records.index') }}" class="text-sm text-indigo-600 hover:underline">&larr; Volver al
                listado</a>
        </div>

        {{-- Datos del paciente --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Mascota</h2>
                <div class="text-sm text-gray-900"><strong>Nombre:</strong> {{ $clinicalRecord->pet->pet_name }}</div>
                <div class="text-sm text-gray-900"><strong>Especie:</strong> {{ $clinicalRecord->pet->species }}</div>
                <div class="text-sm text-gray-900"><strong>Raza:</strong> {{ $clinicalRecord->pet->breed }}</div>
                <div class="text-sm text-gray-900"><strong>Sexo:</strong> {{ $clinicalRecord->pet->sex }}</div>
                <div class="text-sm text-gray-900"><strong>Color:</strong> {{ $clinicalRecord->pet->color }}</div>
                <div class="text-sm text-gray-900"><strong>Fecha nacimiento:</strong>
                    {{ $clinicalRecord->pet->date_of_birth ?? '-' }}</div>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Propietario</h2>
                <div class="text-sm text-gray-900"><strong>Nombre:</strong> {{ $clinicalRecord->pet->client->name }}
                    {{ $clinicalRecord->pet->client->lastname }}</div>
                <div class="text-sm text-gray-900"><strong>Email:</strong> {{ $clinicalRecord->pet->client->email }}</div>
                <div class="text-sm text-gray-900"><strong>Teléfono:</strong>
                    {{ $clinicalRecord->pet->client->phone ?? '-' }}</div>
                <div class="text-sm text-gray-900"><strong>Dirección:</strong>
                    {{ $clinicalRecord->pet->client->address ?? '-' }}</div>
            </div>
        </div>

        {{-- Datos clínicos --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Información Clínica</h2>
                <div class="text-sm text-gray-900"><strong>Fecha de atención:</strong>
                    {{ $clinicalRecord->date->format('d/m/Y H:i') }}</div>
                <div class="text-sm text-gray-900"><strong>Veterinario:</strong> {{ $clinicalRecord->vet->name }}
                    {{ $clinicalRecord->vet->lastname }}</div>
                <div class="text-sm text-gray-900"><strong>Peso:</strong>
                    {{ $clinicalRecord->weight ? $clinicalRecord->weight . ' kg' : '-' }}</div>
                <div class="text-sm text-gray-900"><strong>Temperatura:</strong>
                    {{ $clinicalRecord->temperature ? $clinicalRecord->temperature . ' °C' : '-' }}</div>
            </div>
        </div>

        {{-- Diagnóstico y tratamiento --}}
        <div class="grid grid-cols-1 gap-6 mb-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Síntomas</h2>
                <p class="text-sm text-gray-900 bg-gray-50 p-4 rounded-md">{{ $clinicalRecord->symptoms }}</p>
            </div>

            @if($clinicalRecord->diagnosis)
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Diagnóstico</h2>
                    <p class="text-sm text-gray-900 bg-gray-50 p-4 rounded-md">{{ $clinicalRecord->diagnosis }}</p>
                </div>
            @endif

            @if($clinicalRecord->treatment)
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Tratamiento</h2>
                    <p class="text-sm text-gray-900 bg-gray-50 p-4 rounded-md">{{ $clinicalRecord->treatment }}</p>
                </div>
            @endif

            @if($clinicalRecord->notes)
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Notas Adicionales</h2>
                    <p class="text-sm text-gray-900 bg-gray-50 p-4 rounded-md">{{ $clinicalRecord->notes }}</p>
                </div>
            @endif
        </div>
        <div class="flex justify-center mt-6">
            <a href="{{ route('clinical_records.download_pdf', $clinicalRecord->id) }}"
                class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Descargar PDF
            </a>

        </div>





    </div>
@endsection