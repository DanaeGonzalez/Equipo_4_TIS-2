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
                <td class="border"> {{-- Al td no puedo dar más que borde, si no, queda desordenado--}}
                    <div class="flex py-2 px-4 flex justify-center items-center gap-4"> {{-- Aquí si puedo--}}
                        <a href="{{ route('products.edit', $product) }}"
                            class="text-blue-600 hover:underline flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16 3l5 5m0 0L10 19H5v-5L16 3z" />
                            </svg>
                            Editar
                        </a>
                        <a href="{{ route('products.adjustStockForm', $product) }}"
                            class="text-blue-600 hover:underline flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                            </svg>
                            Stock
                        </a>
                        <a href="{{ route('products.movements', $product) }}"
                            class="text-blue-600 hover:underline flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V13.5Zm0 2.25h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V18Zm2.498-6.75h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V13.5Zm0 2.25h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V18Zm2.504-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5Zm0 2.25h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V18Zm2.498-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5ZM8.25 6h7.5v2.25h-7.5V6ZM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0 0 12 2.25Z" />
                            </svg>
                            Movimientos
                        </a>

                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                            class="flex items-center gap-1"> {{--Ojo--}}
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

                    </div>
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