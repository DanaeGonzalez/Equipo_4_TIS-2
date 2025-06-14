@extends('tenant.layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold mb-4">Crear Cliente</h2>

    <form action="{{ route('clients.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Nombre</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Apellido</label>
            <input type="text" name="lastname" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">RUT</label>
            <input type="text" name="client_run" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Teléfono</label>
            <input type="text" name="phone" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700">Dirección</label>
            <textarea name="address" rows="3" class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection
