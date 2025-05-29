@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Detalle de Boleta</h2>

    <div class="mb-4">
        <strong>Cliente:</strong> {{ $billing->client->name }} {{ $billing->client->lastname }}<br>
        <strong>RUT:</strong> {{ $billing->client->client_run }}<br>
        <strong>Email:</strong> {{ $billing->client->email }}
    </div>

    <div class="mb-4">
        <strong>Tipo de venta:</strong> {{ $billing->sale_type }}<br>
        <strong>Fecha de pago:</strong> {{ $billing->payment_date->format('d-m-Y H:i') }}<br>
        <strong>Método de pago:</strong> {{ $billing->payment_method }}<br>
        <strong>Estado:</strong> {{ $billing->status }}<br>
        <strong>Monto total:</strong> ${{ number_format($billing->total_amount, 0, ',', '.') }}
    </div>

    @if($billing->sale_type === 'Servicio' && $billing->appointment)
        <div class="mb-4">
            <strong>Detalle del servicio (cita):</strong><br>
            Fecha: {{ $billing->appointment->appointments_date }}<br>
            Profesional: {{ $billing->appointment->vet_id->name ?? 'N/A' }}<br>
            Servicio: {{ $billing->appointment->service_id ?? 'Sin detalles' }}
        </div>
    @endif

    @if($billing->sale_type === 'Producto')
        <div class="mb-4">
            <strong>Productos vendidos:</strong>
            <ul class="list-disc list-inside">
                @foreach($billing->products as $product)
                    <li>{{ $product->name }} (x{{ $product->pivot->quantity }}) - ${{ number_format($product->pivot->total_price, 0, ',', '.') }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('billing.download', $billing) }}" method="POST">
        @csrf
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Descargar PDF
        </button>
    </form>
</div>
@endsection
