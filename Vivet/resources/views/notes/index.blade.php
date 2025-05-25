@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-6 py-10">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">📝 Mis Notas</h1>
            <a href="{{ route('notes.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium shadow transition duration-200">
                + Nueva Nota
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($notes as $note)
                <div
                    class="bg-white border border-gray-100 rounded-2xl shadow-md hover:shadow-lg transition duration-300 p-5 min-h-[140px] flex flex-col justify-between">
                    <div>
                        <h2 class="font-semibold text-lg text-gray-800 mb-2">
                            {{ $note->title ?? '🗒️ Sin título' }}
                        </h2>
                        <p class="text-gray-600 text-sm whitespace-pre-line">{{ $note->content }}</p>
                    </div>
                    <div class="flex justify-between text-sm mt-4">
                        <a href="{{ route('notes.edit', $note) }}"
                            class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.414 2.586a2 2 0 0 0-2.828 0L6 11.172V14h2.828l8.586-8.586a2 2 0 0 0 0-2.828z" />
                            </svg>
                            Editar
                        </a>
                        <form action="{{ route('notes.destroy', $note) }}" method="POST"
                            onsubmit="return confirm('¿Eliminar nota?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M6 6h8v10a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V6zm3-2a1 1 0 0 1 2 0h3a1 1 0 1 1 0 2h-1v10a4 4 0 0 1-4 4H9a4 4 0 0 1-4-4V6H4a1 1 0 1 1 0-2h3z" />
                                </svg>
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center col-span-full text-gray-500 italic">No tienes notas aún.</div>
            @endforelse
        </div>

    </div>
@endsection