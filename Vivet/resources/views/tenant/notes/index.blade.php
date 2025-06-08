@extends('tenant.layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-6 py-10">
        <div class="flex items-center justify-between mb-8">
            <h2 class="flex-1 text-center text-3xl font-bold text-gray-800">Mis Notas</h2>
            <a href="{{ route('notes.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium shadow transition duration-200"
                style="background-color: var(--color-button-secondary);">
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
                <div class="bg-white border rounded-2xl shadow-md hover:shadow-lg transition duration-300 p-5 min-h-[140px] flex flex-col justify-between
                                                {{ $note->is_pinned ? '' : 'border-gray-100' }}"
                    style="{{ $note->is_pinned ? 'border-color: var(--color-button-secondary); border-width: 1px;' : '' }}">
                    <div>
                        <h2 class="font-semibold text-lg text-gray-800 mb-2 flex items-center gap-2">
                            {{ $note->title ?? 'Sin título' }}
                        </h2>
                        <p class="text-gray-600 text-sm whitespace-pre-line">{{ $note->content }}</p>
                    </div>
                    <div class="flex justify-end text-sm mt-4 relative">
                        <!-- Botón menú desplegable -->
                        <button id="dropdownMenuIconButton-{{ $note->id }}" data-dropdown-toggle="dropdownDots-{{ $note->id }}"
                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100
                                                               focus:ring-4 focus:outline-none focus:ring-gray-50"
                            type="button" aria-expanded="false" aria-haspopup="true">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 4 15">
                                <path
                                    d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                            </svg>
                        </button>

                        <!-- Menú desplegable -->
                        <div id="dropdownDots-{{ $note->id }}"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-100 dark:divide-gray-300 absolute right-0 mt-10">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-800" role="menu"
                                aria-labelledby="dropdownMenuIconButton-{{ $note->id }}">
                                <li role="none">
                                    <a href="{{ route('notes.edit', $note) }}"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-200 dark:hover:text-gray-900"
                                        role="menuitem">
                                        Editar
                                    </a>
                                </li>
                                <li role="none">
                                    <form action="{{ route('notes.destroy', $note) }}" method="POST"
                                        onsubmit="return confirm('¿Eliminar nota?')" role="none">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-200 dark:hover:text-gray-900"
                                            role="menuitem">
                                            Eliminar
                                        </button>
                                    </form>
                                </li>


                            </ul>
                        </div>


                    </div>
                    <div class="px-4 py-2 text-xs text-gray-500">
                        {{ \Carbon\Carbon::parse($note->fecha)->format('d-m-Y') }}
                    </div>
                </div>
            @empty
                <div class="text-center col-span-full text-gray-500 italic">No tienes notas aún.</div>
            @endforelse
        </div>

    </div>
@endsection