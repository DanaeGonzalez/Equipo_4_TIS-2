@extends('tenant.layouts.dashboard')

@section('content')
{{-- @can('pets.create')--}}
<div class="container mx-auto px-4 py-6 max-w-3xl">
    <h2 class="text-2xl font-bold mb-6">Registrar Nueva Mascota</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pets.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="client_id" class="block font-semibold">DueÃ±o</label>
            <select name="client_id" id="client_id" required class="w-full border rounded px-3 py-2">
                <option value="">-- Selecciona un cliente --</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="pet_name" class="block font-semibold">Nombre de la mascota</label>
            <input type="text" name="pet_name" id="pet_name" value="{{ old('pet_name') }}" required
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="species" class="block font-semibold">Especie</label>
                <input type="text" name="species" id="species" value="{{ old('species') }}" required
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="breed" class="block font-semibold">Raza</label>
                <input type="text" name="breed" id="breed" value="{{ old('breed') }}"
                       class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="color" class="block font-semibold">Color</label>
                <input type="text" name="color" id="color" value="{{ old('color') }}" required
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="sex" class="block font-semibold">Sexo</label>
                <select name="sex" id="sex" required class="w-full border rounded px-3 py-2">
                    <option value="">-- Selecciona --</option>
                    <option value="Macho" {{ old('sex') == 'Macho' ? 'selected' : '' }}>Macho</option>
                    <option value="Hembra" {{ old('sex') == 'Hembra' ? 'selected' : '' }}>Hembra</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="date_of_birth" class="block font-semibold">Fecha de nacimiento</label>
                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label for="microchip_number" class="block font-semibold">Microchip</label>
                <input type="text" name="microchip_number" id="microchip_number" value="{{ old('microchip_number') }}"
                       class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div>
            <label for="notes" class="block font-semibold">Notas</label>
            <textarea name="notes" id="notes" rows="3"
                      class="w-full border rounded px-3 py-2">{{ old('notes') }}</textarea>
        </div>

        <div class="mt-6">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Guardar Mascota
            </button>
            <a href="{{ route('pets.index') }}"
               class="ml-2 text-gray-600 hover:underline">
                Cancelar
            </a>
        </div>
    </form>
</div>

{{-- @endcan --}}
@endsection
