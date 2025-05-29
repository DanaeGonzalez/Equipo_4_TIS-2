@extends('tenant.layouts.app')

@section('title', 'Nuevo permiso')

@section('content')
<div class="max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4">Crear nuevo permiso</h1>

    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf
        <label class="block mb-2">Nombre del permiso</label>
        <input type="text" name="name" class="w-full border px-3 py-2 mb-4" required>
        <label class="block mb-2">Descripción</label>
        <input type="text" name="description" class="w-full border px-3 py-2 mb-4" required>
        <button class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
    </form>
</div>
@endsection
