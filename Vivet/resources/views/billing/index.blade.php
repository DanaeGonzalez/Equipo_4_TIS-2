@extends('layouts.app')
@include('partials.colors')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Facturas</h2>
            @can('billing.create')
                <a href="{{ route('billing.create') }}"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    Nueva Factura
                </a>
            @endcan
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm uppercase text-gray-600">
                        <th class="px-4 py-2">Cliente</th>
                        <th class="px-4 py-2">Tipo de Venta</th>
                        <th class="px-4 py-2">Monto Total</th>
                        <th class="px-4 py-2">Método de Pago</th>
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Estado</th>
                        @can('billing.edit')
                            <th class="px-4 py-2">Acciones</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach($billings as $billing)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $billing->client->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $billing->sale_type }}</td>
                            <td class="px-4 py-2">${{ $billing->total_amount }}</td>
                            <td class="px-4 py-2">{{ $billing->payment_method }}</td>
                            <td class="px-4 py-2">{{ $billing->payment_date->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">{{ $billing->status }}</td>
                            <td class="px-4 py-2 space-x-2">
                                @can('billing.view')
                                    <a href="{{ route('billing.show', $billing) }}" class="text-blue-600 hover:underline">Ver</a>
                                @endcan
                                @can('billing.edit')
                                    <a href="{{ route('billing.edit', $billing) }}"
                                        class="text-yellow-600 hover:underline">Editar</a>
                                @endcan
                                @can('billing.delete')
                                    <form action="{{ route('billing.destroy', $billing) }}" method="POST" class="inline"
                                        onsubmit="return confirm('¿Estás seguro de eliminar esta factura?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $billings->links() }}
        </div>
    </div>
@endsection