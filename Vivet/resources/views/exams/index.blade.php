@extends('layouts.app')

@section('content')
<!-- <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Lista de Tutores</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        {{-- <th class="p-2 border">#</th> --}}
                        <th class="p-2 border">Nombre</th>
                        <th class="p-2 border">Apellido</th>
                        <th class="p-2 border">Email</th>
                        @can('users.edit')
                        <th class="p-2 border">Acciones</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="border-t">
                            {{-- <td class="p-2 border">{{ $user->id }}</td> --}}
                            <td class="p-2 border">{{ $user->name }}</td>
                            <td class="p-2 border">{{ $user->lastname }}</td>
                            <td class="p-2 border">{{ $user->email }}</td>
                            @can('users.edit')
                            <td class="p-2 border">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="text-indigo-600 hover:underline flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16 3l5 5m0 0L10 19H5v-5L16 3z" />
                                    </svg>
                                    Editar
                                </a>
                                @if(auth()->id() !== $user->id)
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Eliminar
                                        </button>
                                    </form>
                                @endif
                            </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="p-4 text-center text-gray-600">No hay usuarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div> -->
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Enviar Examen a Usuarios</h1>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Nombre</th>
                    <th class="p-2 border">Apellido</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Archivo</th>
                    <th class="p-2 border">Enviar</th>
                    <th class="p-2 border">Historial</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="border-t">
                    <form method="POST" action="{{ route('exams.send') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="recipient_id" value="{{ $user->id }}">
                        <td class="p-2 border">{{ $user->name }}</td>
                        <td class="p-2 border">{{ $user->lastname }}</td>
                        <td class="p-2 border">{{ $user->email }}</td>
                        <td class="p-2 border">
                            <input type="file" name="exam_file" accept=".pdf,.doc,.docx" class="border p-1 w-full" required>
                        </td>
                        <td class="p-2 border text-center">
                            <button type="submit" class="bg-indigo-500 text-white px-3 py-1 rounded hover:bg-indigo-600">
                                Enviar
                            </button>
                        </td>
                        <td class="p-2 border text-center">
                            <a href="{{ route('exams.history', $user->id) }}" class="text-blue-600 hover:underline">
                                Ver historial
                            </a>
                        </td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection