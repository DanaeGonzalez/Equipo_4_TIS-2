<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Boleta #{{ $billing->id }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 120px;
            height: auto;
        }

        h1 {
            flex-grow: 1;
            text-align: center;
            margin: 0;
            font-size: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        .totals {
            text-align: right;
            font-weight: bold;
        }

        .details p {
            margin: 2px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="logo">
        <h1>Boleta #{{ $billing->id }}</h1>
    </div>

    <div class="details">
        <p><strong>Cliente:</strong> {{ $billing->client->name }} {{ $billing->client->lastname }}</p>
        <p><strong>RUN:</strong> {{ $billing->client->client_run }}</p>
        <p><strong>Tipo de Venta:</strong> {{ $billing->sale_type }}</p>
        <p><strong>Método de Pago:</strong> {{ $billing->payment_method }}</p>
        <p><strong>Fecha de Pago:</strong> {{ $billing->payment_date->format('d/m/Y') }}</p>
        <p><strong>Estado:</strong> {{ $billing->status }}</p>
    </div>

    @if($billing->sale_type === 'Servicio' && $billing->appointment)
        <p><strong>Servicio:</strong> {{ $billing->appointment->service ?? 'N/A' }}</p>
    @endif

    @if($billing->sale_type === 'Producto' && $billing->products->isNotEmpty())
        <h3>Productos Vendidos</h3>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Precio Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($billing->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>${{ number_format($product->pivot->unit_price, 0, ',', '.') }}</td>
                        <td>${{ number_format($product->pivot->total_price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <p class="totals">Total a Pagar: ${{ number_format($billing->total_amount, 0, ',', '.') }}</p>
</body>

</html>