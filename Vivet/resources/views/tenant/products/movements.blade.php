@extends('tenant.layouts.app')
@include('tenant.partials.colors')
@section('title', 'Entrada y Salida de Insumos')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Movimientos de inventario: {{ $product->name }}</h1>

    @if(session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if($movements->isEmpty())
    <p class="text-gray-600">No hay movimientos registrados para este insumo.</p>
    @else
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border rounded-lg shadow">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">Fecha</th>
                    <th class="p-3 text-left">Tipo</th>
                    <th class="p-3 text-left">Cantidad</th>
                    <th class="p-3 text-left">Razón</th>
                    <th class="p-3 text-left">Registrado por</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movements as $movement)
                <tr class="border-t hover:bg-gray-100">
                    <td class="p-3">{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                    <td class="p-3 capitalize">
                        {{ $movement->movement_type === 'entrada' ? 'Entrada' : 'Salida' }}
                    </td>
                    <td class="p-3">{{ $movement->quantity }}</td>
                    <td class="p-3">{{ $movement->reason }}</td>
                    <td class="p-3">{{ $movement->user->name ?? 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="mt-6">
        <a style="background-color: var(--color-button-secondary);" class="bg-indigo-600 text-white px-4 py-2 rounded" href="{{ route('products.index') }}">← Volver a products</a>
    </div>
</div>
@endsection