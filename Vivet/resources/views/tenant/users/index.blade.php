@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Lista de Usuarios</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @can('users.create')
            <a href="{{ route('users.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Nuevo Usuario</a>
        @endcan

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        {{-- <th class="p-2 border">#</th> --}}
                        <th class="p-2 border">Nombre</th>
                        <th class="p-2 border">Apellido</th>
                        <th class="p-2 border">RUN</th>
                        <th class="p-2 border">Sexo</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Rol</th>
                        <th class="p-2 border">Activo</th>
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
                            <td class="p-2 border">{{ $user->run }}</td>
                            <td class="p-2 border">{{ $user->sex }}</td>
                            <td class="p-2 border">{{ $user->email }}</td>
                            <td class="p-2 border">{{ $user->role->name ?? 'N/A' }}</td>
                            <td class="p-2 border">
                                @if($user->is_active)
                                    <span class="text-green-600 font-bold">Sí</span>
                                @else
                                    <span class="text-red-600 font-bold">No</span>
                                @endif
                            </td>
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
    </div>
@endsection