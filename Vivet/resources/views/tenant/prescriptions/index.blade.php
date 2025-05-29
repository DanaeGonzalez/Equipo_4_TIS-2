@extends('tenant.layouts.app')
@include('tenant.partials.colors')

@section('title', 'Prescripciones Médicas')
@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Prescripciones</h1>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full table-auto border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Ficha Clínica</th>
                    <th class="p-2 border">Medicamento</th>
                    <th class="p-2 border">Dosis</th>
                    <th class="p-2 border">Duración</th>
                    <th class="p-2 border">Notas</th>
                    <th class="p-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($prescriptions as $prescription)
                    <tr>
                        <td class="p-2 border text-center">#{{ $prescription->clinical_record_id }}</td>
                        <td class="p-2 border text-center">{{ $prescription->medication->name ?? '-' }}</td>
                        <td class="p-2 border text-center">{{ $prescription->dosage }}</td>
                        <td class="p-2 border text-center">{{ $prescription->duration }}</td>
                        <td class="p-2 border text-center">{{ $prescription->notes }}</td>
                        <td class="p-2 border text-center">
                            <div class="flex justify-center items-center gap-4">
                                <a href="{{ route('prescriptions.edit', $prescription) }}"
                                   class="text-blue-600 hover:underline flex items-center gap-1">
                                    ✏️ Editar
                                </a>
                                <form action="{{ route('prescriptions.destroy', $prescription) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline flex items-center gap-1 mt-1">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-4">No hay prescripciones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
