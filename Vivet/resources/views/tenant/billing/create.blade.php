@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-2xl">
    <h2 class="text-2xl font-bold mb-4">Registrar Factura</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('billing.store') }}" method="POST" class="space-y-4 bg-white shadow p-6 rounded">
        @csrf

        <div>
            <label class="block font-semibold">Cliente</label>
            <select name="client_id" class="w-full border-gray-300 rounded">
                <option value="">-- Seleccionar cliente --</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold">Tipo de Venta</label>
            <select name="sale_type" class="w-full border-gray-300 rounded" required>
                <option value="Servicio">Servicio</option>
                <option value="Producto">Producto</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold">Cita Asociada (opcional)</label>
            <select name="appointment_id" class="w-full border-gray-300 rounded">
                <option value="">-- Ninguna --</option>
                @foreach($appointments as $appt)
                    <option value="{{ $appt->id }}">Cita #{{ $appt->id }} - {{ $appt->user->name ?? '' }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold">Monto Total</label>
            <input type="number" name="total_amount" class="w-full border-gray-300 rounded" required min="0">
        </div>

        <div>
            <label class="block font-semibold">Método de Pago</label>
            <select name="payment_method" class="w-full border-gray-300 rounded" required>
                <option value="Débito">Débito</option>
                <option value="Crédito">Crédito</option>
                <option value="Efectivo">Efectivo</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold">Fecha de Pago</label>
            <input type="date" name="payment_date" class="w-full border-gray-300 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Estado</label>
            <select name="status" class="w-full border-gray-300 rounded" required>
                <option value="Pendiente">Pendiente</option>
                <option value="Pagado">Pagado</option>
                <option value="Cancelado">Cancelado</option>
            </select>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Guardar Factura
            </button>
        </div>
    </form>
</div>
@endsection
