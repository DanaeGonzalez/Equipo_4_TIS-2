@extends('tenant.layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold mb-4">Editar Cliente</h2>

    <form action="{{ route('clients.update', $client->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $client->name) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Apellido</label>
            <input type="text" name="lastname" value="{{ old('lastname', $client->lastname) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">RUT</label>
            <input type="text" name="client_run" value="{{ old('client_run', $client->client_run) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $client->email) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Teléfono</label>
            <input type="text" name="phone" value="{{ old('phone', $client->phone) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700">Dirección</label>
            <textarea name="address" rows="3" class="w-full border rounded px-3 py-2">{{ old('address', $client->address) }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
