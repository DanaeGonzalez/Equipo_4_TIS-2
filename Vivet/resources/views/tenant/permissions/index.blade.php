@extends('layouts.app')
@include('partials.colors')
@section('title', 'Permisos')

@section('content')
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Lista de permisos</h1>

        <a href="{{ route('permissions.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">Nuevo Permiso</a>

        <ul class="mt-4 space-y-2">
            @if(session('success'))
                <div class="mb-4 text-green-600 font-semibold">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 text-red-600 font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <select name="entity" class="p-2 border rounded">
                    <option value="">-- Filtrar por vista --</option>
                    @foreach ($entities as $entity)
                        <option value="{{ $entity }}" {{ request('entity') == $entity ? 'selected' : '' }}>
                            {{ ucfirst($entity) }}
                        </option>
                    @endforeach
                </select>

                <select name="action" class="p-2 border rounded">
                    <option value="">-- Tipo de permiso --</option>
                    @foreach ($actions as $action)
                        <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                            {{ ucfirst($action) }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                    class="w-full col-span-1 md:col-span-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Filtrar
                </button>
                <a href="{{ route('permissions.index') }}"
                    class="w-full block text-center px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Restablecer
                    filtros</a>

            </form>
            @foreach ($groupedPermissions as $entity => $permissions)
                <div class="mb-6">
                    <h2 class="text-xl font-semibold mb-2 border-b pb-1">{{ $entity }}</h2>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        @foreach ($permissions as $permission)
                            <li class="flex justify-between items-center border p-2 rounded">
                                <span>{{ $permission->name }}</span>
                                <div class="flex py-2 px-4 flex justify-center items-center gap-4"> {{-- Aquí si puedo--}}
                                    <a href="{{ route('permissions.edit', $permission) }}"
                                        class="text-blue-600 hover:underline flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16 3l5 5m0 0L10 19H5v-5L16 3z" />
                                        </svg>
                                        Editar
                                    </a>
                                    <form action="{{ route('permissions.destroy', $permission) }}" method="POST"
                                        class="flex items-center gap-1"> {{--Ojo--}}
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline flex items-center gap-1 mt-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
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
            @endforeach
            <div class="mt-6">
                {{-- {{ $permissions->withQueryString()->links('vendor.pagination.tailwind') }} --}}
            </div>
        </ul>
    </div>
@endsection