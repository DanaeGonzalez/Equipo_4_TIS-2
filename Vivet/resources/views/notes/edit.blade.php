@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Editar Nota</h1>

    <form action="{{ route('notes.update', $note) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Título (opcional)</label>
            <input type="text" name="title" class="w-full border rounded px-3 py-2 mt-1" value="{{ old('title', $note->title) }}">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Contenido</label>
            <textarea name="content" rows="5" required class="w-full border rounded px-3 py-2 mt-1">{{ old('content', $note->content) }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
    </form>
</div>
@endsection
