@extends('tenant.layouts.app')

@section('title', 'Permisos')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Lista de permisos</h1>

        <a href="{{ route('permissions.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">Nuevo Permiso</a>

        <ul class="mt-4 space-y-2">
            @foreach($permissions as $permission)
                <li class="flex justify-between items-center border p-2">
                    <span>{{ $permission->name }}</span>
                    <div class="flex items-center space-x-2">
                        <!-- Edit button -->
                        <a href="{{ route('permissions.edit', $permission) }}" class="text-blue-500 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                              </svg>
                              
                            Editar
                        </a>

                        <!-- Delete form -->
                        <form action="{{ route('permissions.destroy', $permission) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 flex items-center" onclick="return confirm('¿Eliminar permiso?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Eliminar
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection