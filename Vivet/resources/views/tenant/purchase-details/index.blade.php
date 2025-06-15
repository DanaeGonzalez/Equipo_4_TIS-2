@extends('tenant.layouts.app')
@include('tenant.partials.colors')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Detalles de Compra</h1>

        <!-- Filtros -->
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <select name="item_type" class="p-2 border rounded">
                <option value="">-- Tipo de ítem --</option>
                <option value="producto" {{ request('item_type') == 'producto' ? 'selected' : '' }}>Producto</option>
                <option value="insumo" {{ request('item_type') == 'insumo' ? 'selected' : '' }}>Insumo</option>
            </select>

            <input type="date" name="from_date" value="{{ request('from_date') }}" class="p-2 border rounded"
                placeholder="Desde">
            <input type="date" name="to_date" value="{{ request('to_date') }}" class="p-2 border rounded"
                placeholder="Hasta">

            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 col-span-1 md:col-span-4">Filtrar</button>
        </form>

        <!-- Tabla de detalles de compra -->
        <div class="overflow-auto bg-white shadow rounded">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3">Fecha de compra</th>
                        <th class="p-3">Ítem</th>
                        <th class="p-3">Proveedor</th>
                        <th class="p-3">Cantidad</th>
                        <th class="p-3">Costo Unitario</th>
                        <th class="p-3">Costo Total</th>
                        <th class="p-3">Factura</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchaseDetails as $detail)
                        <tr class="border-b">
                            <td class="p-3">{{ \Carbon\Carbon::parse($detail->purchase_date)->format('d/m/Y') }}</td>
                            <td class="p-3">
                                {{ $detail->inventoryMovement->item->name ?? '-' }}
                            </td>
                            <td class="p-3">{{ $detail->supplier->name ?? 'N/A' }}</td>
                            <td class="p-3">{{ $detail->quantity }}</td>
                            <td class="p-3">${{ number_format($detail->unit_cost, 0, ',', '.') }}</td>
                            <td class="p-3 font-semibold">${{ number_format($detail->total_cost, 0, ',', '.') }}</td>
                            <td class="p-3">{{ $detail->invoice_number ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-4 text-center text-gray-500">No se encontraron registros de compra.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{--<!-- Paginación -->
        <div class="mt-4">
            {{ $purchaseDetails->withQueryString()->links() }}
        </div>--}}
    </div>
@endsection