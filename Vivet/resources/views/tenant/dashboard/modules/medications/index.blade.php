@extends('tenant.layouts.app')
@include('tenant.partials.colors')

@section('title', 'Lista de Medicamentos')
@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Medicamentos</h1>

        <a style="background-color: var(--color-button-secondary);" href="{{ route('medications.create') }}"
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
            + Nuevo Medicamento
        </a>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full table-auto border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Nombre</th>
                    <th class="p-2 border">Descripción</th>
                    <th class="p-2 border">Instrucciones de Dosis</th>
                    <th class="p-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($medications as $medication)
                    <tr>
                        <td class="p-2 border text-center">{{ $medication->name }}</td>
                        <td class="p-2 border text-center">{{ $medication->description }}</td>
                        <td class="p-2 border text-center">{{ $medication->dosage_instructions }}</td>
                        <td class="p-2 border text-center">
                            <div class="flex justify-center items-center gap-4">
                                <a href="{{ route('medications.edit', $medication) }}"
                                   class="text-blue-600 hover:underline flex items-center gap-1">
                                    ✏️ Editar
                                </a>
                                <form action="{{ route('medications.destroy', $medication) }}" method="POST">
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
                        <td colspan="4" class="text-center p-4">No hay medicamentos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
