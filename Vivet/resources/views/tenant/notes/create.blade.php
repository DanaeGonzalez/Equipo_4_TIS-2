@extends('tenant.layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Crear Nota</h1>

        <form action="{{ route('notes.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Título (opcional)</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2 mt-1" value="{{ old('title') }}">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Contenido</label>
                <textarea name="content" rows="5" required
                    class="w-full border rounded px-3 py-2 mt-1">{{ old('content') }}</textarea>
            </div>
            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_pinned" value="1" {{ old('is_pinned') ? 'checked' : '' }}
                        class="form-checkbox h-5 w-5 text-green-600">
                    <span class="ml-2 text-gray-700">Fijar nota</span>
                </label>
            </div>

            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded" style="background-color: var(--color-button-secondary);">Guardar</button>
        </form>
    </div>
@endsection