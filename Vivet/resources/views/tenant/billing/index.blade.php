@extends('layouts.app')
@include('partials.colors')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Facturas</h2>
        {{-- @if ($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif --}}
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
                    <div class="flex items-center space-x-2">
                    @can('billing.show')
                    <a href="{{ route('billing.show', $billing) }}" class="text-blue-600 hover:underline flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>Ver</a>
                    @endcan
                    @can('billing.edit')
                    <a href="{{ route('billing.edit', $billing) }}"
                        class="text-blue-600 hover:underline flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16 3l5 5m0 0L10 19H5v-5L16 3z" />
                        </svg>
                        Editar
                    </a>
                    @endcan
                    @can('billing.delete')
                    <form action="{{ route('billing.destroy', $billing) }}" method="POST" class="inline"
                        onsubmit="return confirm('¿Estás seguro de cancelar esta factura?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de cancelar esta Factura?')"
                                class="text-red-600 hover:underline flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Eliminar
                            </button>
                    </form>
                    @endcan
                </td>
                </div>
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