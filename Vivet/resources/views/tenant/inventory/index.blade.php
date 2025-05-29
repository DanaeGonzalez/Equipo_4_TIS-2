@extends('tenant.layouts.app')
@include('tenant.partials.colors')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Movimientos de Inventario</h1>

    <!-- Filtros -->
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <select name="movement_type" class="p-2 border rounded">
            <option value="">-- Tipo de movimiento --</option>
            <option value="entrada" {{ request('movement_type') == 'entrada' ? 'selected' : '' }}>Entrada</option>
            <option value="salida" {{ request('movement_type') == 'salida' ? 'selected' : '' }}>Salida</option>
        </select>

        <select name="item_type" class="p-2 border rounded">
            <option value="">-- Tipo de ítem --</option>
            <option value="producto" {{ request('item_type') == 'producto' ? 'selected' : '' }}>Producto</option>
            <option value="insumo" {{ request('item_type') == 'insumo' ? 'selected' : '' }}>Insumo</option>
        </select>

        <input type="date" name="from_date" value="{{ request('from_date') }}" class="p-2 border rounded" placeholder="Desde">
        <input type="date" name="to_date" value="{{ request('to_date') }}" class="p-2 border rounded" placeholder="Hasta">

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 col-span-1 md:col-span-4">Filtrar</button>
    </form>

    <!-- Tabla de movimientos -->
    <div class="overflow-auto bg-white shadow rounded">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Fecha</th>
                    <th class="p-3">Ítem</th>
                    <th class="p-3">Tipo</th>
                    <th class="p-3">Movimiento</th>
                    <th class="p-3">Cantidad</th>
                    <th class="p-3">Motivo</th>
                    <th class="p-3">Usuario</th>
                </tr>
            </thead>
            <tbody>
                @forelse($movements as $movement)
                <tr class="border-b">
                    <td class="p-3">{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                    <td class="p-3">
                        {{ optional($movement->item)->name ?? 'N/A' }}
                    </td>
                    <td class="p-3">
                        {{ class_basename($movement->item_type) }}
                    </td>
                    <td class="p-3">
                        <span class="inline-block px-2 py-1 rounded text-white
                                {{ $movement->movement_type === 'entrada' ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ ucfirst($movement->movement_type) }}
                        </span>
                    </td>
                    <td class="p-3">{{ $movement->quantity }}</td>
                    <td class="p-3">{{ $movement->reason }}</td>
                    <td class="p-3">{{ $movement->user->name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-500">No se encontraron movimientos.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $movements->withQueryString()->links() }}
    </div>
</div>
@endsection