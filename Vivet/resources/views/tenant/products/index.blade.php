@extends('tenant.layouts.app')

@section('title', 'Lista de Productos')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Productos</h1>
        @can('products.create')
            <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
                + Nuevo Producto
            </a>
        @endcan
        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full table-auto border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Nombre</th>
                    <th class="p-2 border">Precio</th>
                    <th class="p-2 border">Stock</th>
                    @if ($role === 'Administrador')
                        <th class="p-2 border">Activo</th>
                    @endif
                    <th class="p-2 border">Categoría</th>
                    @can('products.edit')
                        <th class="p-2 border">Acciones</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td class="p-2 border text-center">{{ $product->name }}</td>
                        <td class="p-2 border text-center">${{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="p-2 border text-center">{{ $product->stock }}</td>

                        @if ($role === 'Administrador')
                            <td class="p-2 border text-center">
                                @if($product->is_active)
                                    <span class="text-green-600 font-bold">Sí</span>
                                @else
                                    <span class="text-red-600 font-bold">No</span>
                                @endif
                            </td>
                        @endif
                        <td class="p-2 border text-center">{{ $product->category}}</td>
                        @can('products.edit')
                            <td class="py-2 px-4 border-b space-x-2 flex justify-center items-center gap-4">

                                <a href="{{ route('products.edit', $product) }}"
                                    class="text-blue-600 hover:underline flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16 3l5 5m0 0L10 19H5v-5L16 3z" />
                                    </svg>
                                    Editar
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
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

                            </td>
                        @endcan
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">No hay productos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection