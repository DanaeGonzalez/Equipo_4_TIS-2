@extends('layouts.app')
@include('partials.colors')

@section('title', 'Editar permiso')

@section('content')
<div class="max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4">Editar permiso</h1>

    <form action="{{ route('permissions.update', $permission) }}" method="POST">
        @csrf
        @method('PUT')
        <label class="block mb-2">Nombre del permiso</label>
        <input type="text" name="name" value="{{ $permission->name }}" class="w-full border px-3 py-2 mb-4" required>
        <label class="block mb-2">Descripción</label>
        <input type="text" name="description" value="{{ $permission->description}}" class="w-full border px-3 py-2 mb-4" required>
        <button style=" " class="bg-blue-600 text-white px-4 py-2 rounded" type="submit">Actualizar</button>
    </form>
</div>
@endsection
