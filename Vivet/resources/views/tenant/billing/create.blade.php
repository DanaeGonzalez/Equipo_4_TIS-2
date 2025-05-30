@extends('tenant.layouts.app')
@include('tenant.partials.colors')
@section('title', 'Crear Factura')

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
            <select id="client_id" name="client_id" class="w-full border-gray-300 rounded">
                <option value="">-- Seleccionar cliente --</option>
                @foreach($clients as $client)
                {{--buscar el run, pero que salga el nombre del cliente--}}
                <option value="{{ $client->id }}" {{ old('client_id', session('new_client_id')) == $client->id ? 'selected' : '' }}>
                    {{ $client->client_run }} - {{ $client->name }} {{ $client->lastname }}
                </option>
                @endforeach
            </select>
            <button style="background-color: var(--color-button-secondary);" type="button" onclick="openClientModal()"
                class="mt-2 bg-green-500 text-white px-3 rounded">Agregar Cliente</button>
        </div>

        <div>
            <label class="block font-semibold">Tipo de Venta</label>
            <select name="sale_type" class="w-full border-gray-300 rounded" required>
                <option value="Servicio" {{old('sale_type') == 'Servicio' ? 'selected' : ''}}>Servicio</option>
                <option value="Producto" {{old('sale_type') == 'Producto' ? 'selected' : ''}}>Producto</option>
            </select>
        </div>

        <div id="servicesFields" class="hidden">
            <label for="appointment_id" class="block font-semibold">Cita Asociada</label>
            <select name="appointment_id" class="w-full border-gray-300 rounded">
                <option value="">-- Ninguna --</option>
                @foreach($appointments as $appt)
                @if ($appt->status === 'realizada')
                <option value="{{ $appt->id }}" data-price="{{ $appt->price ?? 0 }}" {{ old('appointment_id') == $appt->id ? 'selected' : '' }}>
                    Cita #{{ $appt->id }} - {{ $appt->user->name ?? 'Sin usuario' }}
                </option>
                @endif
                @endforeach
            </select>
        </div>

        <div id="productFields" class="hidden">
            <label for="product_id" class="block font-semibold">Productos</label>
            <div id="product-list" class="space-y-2">
                {{--<select id="product_id" name="product_ids[]" multiple class="w-full border-gray-300 rounded">--}}
                {{--<option value="">-- Seleccionar Productos --</option>--}}
                @foreach($products as $product)
                <div class="flex items-center gap-4">
                    <input type="checkbox" name="product_ids[]" value="{{ $product->id }}"
                        data-price="{{ $product->price }}" onchange="toggleProduct(this)">
                    <span>{{ $product->name }} - ${{ $product->price }}</span>

                    <input type="number" name="quantities[{{ $product->id }}]"
                        class="quantity-input w-20 border rounded px-2" placeholder="Cant." min="1"
                        data-product-id="{{ $product->id }}" onchange="updateTotal()" disabled>
                </div>
                @endforeach
                {{--
                    </select>--}}
            </div>

        </div>

        <div>
            <label class="block font-semibold">Monto Total</label>
            <input type="number" id="total_amount" name="total_amount" step="1" class="w-full border-gray-300 rounded"
                required readonly>
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
            <input type="datetime-local" name="payment_date" class="w-full border-gray-300 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Estado</label>
            <select name="status" class="w-full border-gray-300 rounded" required>
                <option value="Pendiente">Pendiente</option>
                <option value="Pagado">Pagado</option>
                <option value="Cancelado">Cancelado</option>
            </select>
        </div>

        <div class="flex justify-end gap-2 pt-2">
            <a href="{{ route('billing.index') }}"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                Cancelar
            </a>
            <button style="background-color: var(--color-button-secondary);" type="submit"
                class="px-4 py-2 text-white rounded hover:bg-blue-700 transition">
                Guardar Factura
            </button>
        </div>
    </form>
    {{-- Crear un cliente nuevo, en caso que no esté en la BD --}}
    <div id="clientModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
        <div class="bg-white rounded p-6 w-full max-w-md space-y-4">
            <h3 class="text-xl font-bold">Nuevo Cliente</h3>
            <form action="{{ route('clients.store.from.billing') }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Nombre" required class="w-full border rounded p-2 my-2">
                <input type="text" name="lastname" placeholder="Apellido" required class="w-full border rounded p-2 my-2">
                <input type="text" name="client_run" placeholder="RUT" required class="w-full border rounded p-2 my-2">
                <input type="email" name="email" placeholder="Correo" required class="w-full border rounded p-2 my-2">
                <input type="text" name="phone" placeholder="Teléfono" required class="w-full border rounded p-2 my-2">
                <input type="text" name="address" placeholder="Dirección" class="w-full border rounded p-2 my-2">

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeClientModal()"
                        class="bg-gray-400 px-3 py-1 rounded text-white">Cancelar</button>
                    <button style="background-color: var(--color-button-secondary);" type="submit"
                        class="px-3 py-1 rounded text-white">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    function toggleSaleFields() {
        const type = document.querySelector('[name="sale_type"]').value;
        document.getElementById('servicesFields').classList.toggle('hidden', type !== 'Servicio');
        document.getElementById('productFields').classList.toggle('hidden', type !== 'Producto');
        updateTotal();
    }

    function toggleProduct(checkbox) {
        const input = document.querySelector(`input[name="quantities[${checkbox.value}]"]`);
        input.disabled = !checkbox.checked;
        updateTotal();
    }

    function updateTotal() {
        let total = 0;
        const type = document.querySelector('[name="sale_type"]').value;

        if (type === 'Servicio') {
            const appt = document.querySelector('[name="appointment_id"]').selectedOptions[0];
            total = appt?.dataset.price ? parseFloat(appt.dataset.price) : 0;
        } else if (type === 'Producto') {
            const productChecks = document.querySelectorAll('input[name="product_ids[]"]:checked');
            productChecks.forEach(checkbox => {
                const price = parseInt(checkbox.dataset.price);
                const quantity = parseInt(document.querySelector(`input[name="quantities[${checkbox.value}]"]`).value) || 0;
                total += price * quantity;
            });
        }

        document.getElementById('total_amount').value = Math.round(total);
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelector('[name="sale_type"]').addEventListener('change', toggleSaleFields);
        document.getElementById('appointment_id')?.addEventListener('change', updateTotal);
        document.getElementById('product_id')?.addEventListener('change', updateTotal);
        toggleSaleFields(); // Inicializa al cargar
    });

    // Cliente modal
    function openClientModal() {
        document.getElementById('clientModal').classList.remove('hidden');
    }

    function closeClientModal() {
        document.getElementById('clientModal').classList.add('hidden');
    }
</script>

@endsection