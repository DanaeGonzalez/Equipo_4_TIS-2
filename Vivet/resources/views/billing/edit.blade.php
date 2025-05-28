@extends('layouts.app')
@section('title', 'Editar Factura')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-xl">
    <h2 class="text-2xl font-bold mb-4">Editar Factura</h2>

    <form action="{{ route('billing.update', $billing->id) }}" method="POST" class="space-y-4 bg-white shadow p-6 rounded">
        @csrf
        @method('PUT')

        {{-- Cliente --}}
        <div>
            <label class="block font-semibold">Cliente</label>
            <input type="text" value="{{ $billing->client->client_run }} - {{ $billing->client->name }} {{ $billing->client->lastname }}" class="w-full border-gray-300 rounded bg-gray-100" disabled>
        </div>

        {{-- Tipo de venta --}}
        <div>
            <label class="block font-semibold">Tipo de Venta</label>
            <input type="text" value="{{ $billing->sale_type }}" class="w-full border-gray-300 rounded bg-gray-100" disabled>
        </div>

        {{-- Cita asociada (si es Servicio) --}}
        @if($billing->sale_type === 'Servicio' && $billing->appointment)
        <div>
            <label class="block font-semibold">Cita</label>
            <input type="text" value="Cita #{{ $billing->appointment->id }} - {{ $billing->appointment->user->name ?? 'Sin usuario' }}" class="w-full border-gray-300 rounded bg-gray-100" disabled>
        </div>
        @endif

        {{-- Monto total --}}
        <div>
            <label class="block font-semibold">Monto Total</label>
            <input type="text" value="${{ $billing->total_amount }}" class="w-full border-gray-300 rounded bg-gray-100" disabled>
        </div>

        {{-- Método de pago (editable) --}}
        <div>
            <label class="block font-semibold">Método de Pago</label>
            <select name="payment_method" class="w-full border-gray-300 rounded">
                <option value="Débito" {{ $billing->payment_method === 'Débito' ? 'selected' : '' }}>Débito</option>
                <option value="Crédito" {{ $billing->payment_method === 'Crédito' ? 'selected' : '' }}>Crédito</option>
                <option value="Efectivo" {{ $billing->payment_method === 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
            </select>
        </div>

        {{-- Estado (editable) --}}
        <div>
            <label class="block font-semibold">Estado</label>
            <select name="status" class="w-full border-gray-300 rounded">
                <option value="Pendiente" {{ $billing->status === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="Pagado" {{ $billing->status === 'Pagado' ? 'selected' : '' }}>Pagado</option>
                <option value="Cancelado" {{ $billing->status === 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
            </select>
        </div>

        {{-- Fecha de pago (solo visual) --}}
        <div>
            <label class="block font-semibold">Fecha de Pago</label>
            <input type="text" value="{{ \Carbon\Carbon::parse($billing->payment_date)->format('d-m-Y H:i') }}" class="w-full border-gray-300 rounded bg-gray-100" disabled>
        </div>

        {{-- Botones --}}
        <div class="flex justify-end gap-2 pt-2">
            <a href="{{ route('billing.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                Cancelar
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection
