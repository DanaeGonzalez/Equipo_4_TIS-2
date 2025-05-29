<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\BillingProducts;
use App\Models\Client;
use App\Models\Appointment;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BillingController extends Controller
{
    public function index()
    {
        $billings = Billing::with(['client', 'appointment'])->latest()->paginate(10);
        return view('tenant.billing.index', compact('billings'));
    }

    public function create()
    {
        $products = Product::all();
        $clients = Client::all();
        $appointments = Appointment::where('status', 'realizada')->get();
        return view('billing.create', compact('products', 'clients', 'appointments'));
    }

    public function store(Request $request)
    {
        // Si se selecciona un cliente existente:
        if ($request->filled('client_id')) {
            $validated = $request->validate([
                'client_id' => 'required|exists:clients,id',
                'sale_type' => 'required|in:Servicio,Producto',
                'appointment_id' => 'nullable|exists:appointments,id',
                'products' => 'nullable|array',
                'products.*.id' => 'required_with:products|exists:products,id',
                'products.*.quantity' => 'required_with:products|integer|min:1',
                'total_amount' => 'required|integer|min:0',
                'payment_method' => 'required|in:Débito,Crédito,Efectivo',
                'payment_date' => 'required|date',
                'status' => 'required|in:Pendiente,Pagado,Cancelado',
            ]);

            $client = Client::findOrFail($request->client_id);
        } else {
            // Si no hay cliente seleccionado, validar datos para crearlo
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'client_run' => 'required|string|max:12',
                'email' => 'required|email',
                'phone' => 'required|string|max:20',
                'address' => 'nullable|string|max:255',

                'sale_type' => 'required|in:Servicio,Producto',
                'appointment_id' => 'nullable|exists:appointments,id',
                'products' => 'nullable|array',
                'products.*.id' => 'required_with:products|exists:products,id',
                'products.*.quantity' => 'required_with:products|integer|min:1',
                'total_amount' => 'required|integer|min:0',
                'payment_method' => 'required|in:Débito,Crédito,Efectivo',
                'payment_date' => 'required|date',
                'status' => 'required|in:Pendiente,Pagado,Cancelado',
            ]);

            $client = Client::where('client_run', $request->client_run)->first();

            if ($client) {
                if ($client->email !== $request->email) {
                    return back()->withErrors(['email' => 'Ya existe un cliente con este RUT pero con otro correo.']);
                }
            } else {
                $user = \App\Models\User::where('run', $request->client_run)->first();

                $client = Client::updateOrCreate([
                    'user_id' => $user?->id ?? auth()->id(),
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'client_run' => $request->client_run,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]);
            }
        }

        if ($request->sale_type === 'Servicio' && !$request->appointment_id) {
            return back()->withErrors(['appointment_id' => 'Debes seleccionar una cita para una venta de tipo Servicio.']);
        }

        $billing = Billing::create([
            'client_id' => $client->id,
            'sale_type' => $request->sale_type,
            'appointment_id' => $request->appointment_id,
            'total_amount' => $request->total_amount,
            'payment_method' => $request->payment_method,
            'payment_date' => $request->payment_date,
            'status' => $request->status,
        ]);

        if ($request->has('product_ids')) {
            foreach ($request->product_ids as $productId) {
                $product = Product::findOrFail($productId);
                $quantity = $request->input("quantities.$productId", 1);
                $unitPrice = $product->price;
                $totalPrice = $unitPrice * $quantity;

                if ($quantity < 1) {
                    return back()->withErrors(['Debe ingresar cantidad válida para el producto seleccionado.']);
                }

                BillingProducts::create([
                    'billing_id' => $billing->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                ]);
            }
        }

        return redirect()->route('billing.index')->with('success', 'Factura registrada correctamente.');
    }

    public function show(Billing $billing)
    {
        $billing->load(['client', 'appointment', 'products']);
        return view('billing.show', compact('billing'));
    }

    public function edit(Billing $billing)
    {
        $billing->load(['client', 'appointment', 'products']);
        return view('billing.edit', compact('billing'));
    }


    public function update(Request $request, Billing $billing)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:Débito,Crédito,Efectivo',
            'status' => 'required|in:Pendiente,Pagado,Cancelado',
        ]);

        $billing->update($validated);

        return redirect()->route('billing.index')->with('success', 'Factura actualizada correctamente.');
    }


    public function destroy(Billing $billing)
    {
        $billing->update(['status' => 'Cancelado']);
        return redirect()->route('billing.index')->with('success', 'Factura Cancelada.');
    }

    public function download(Billing $billing)
    {
        $billing->load(['client', 'appointment', 'products']);

        $pdf = PDF::loadView('billing.pdf', compact('billing'));

        return $pdf->download('boleta_' . $billing->id . '.pdf');
    }
}
