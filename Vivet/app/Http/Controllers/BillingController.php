<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Client;
use App\Models\Appointment;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $billings = Billing::with(['client', 'appointment'])->latest()->paginate(10);
        return view('billing.index', compact('billings'));
    }

    public function create()
    {
        $clients = Client::all();
        $appointments = Appointment::all();
        return view('billing.create', compact('clients', 'appointments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'client_run' => 'required|string|max:12',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',

            'sale_type' => 'required|in:Servicio,Producto',
            'appointment_id' => 'nullable|exists:appointments,id',
            'total_amount' => 'required|integer|min:0',
            'payment_method' => 'required|in:Débito,Crédito,Efectivo',
            'payment_date' => 'required|date',
            'status' => 'required|in:Pendiente,Pagado,Cancelado',
        ]);
        if ($request->sale_type === 'Servicio' && !$request->appointment_id) {
            return back()->withErrors(['appointment_id' => 'Debes seleccionar una cita para una venta de tipo Servicio.']);
        }

        $client = Client::where('client_run', $request->client_run)->first();

        if ($client) {
            // Validar coincidencia de correo electrónico
            if ($client->email !== $request->email) {
                return back()->withErrors(['email' => 'Ya existe un cliente con este RUT pero con otro correo.']);
            }
        } else {
            // Buscar si existe un usuario con el mismo RUN
            $user = \App\Models\User::where('run', $request->client_run)->first();

            // Crear cliente
            $client = Client::create([
                'user_id' => $user?->id ?? auth()->id(),
                'name' => $request->name,
                'lastname' => $request->lastname,
                'client_run' => $request->client_run,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }

        Billing::create([
            'client_id' => $client->id,
            'sale_type' => $request->sale_type,
            'appointment_id' => $request->appointment_id,
            'total_amount' => $request->total_amount,
            'payment_method' => $request->payment_method,
            'payment_date' => $request->payment_date,
            'status' => $request->status,
        ]);

        return redirect()->route('billing.index')->with('success', 'Factura registrada correctamente.');
    }

    public function show(Billing $billing)
    {
        $billing->load(['client', 'appointment']);
        return view('billing.show', compact('billing'));
    }

    public function edit(Billing $billing)
    {
        $clients = Client::all();
        $appointments = Appointment::all();
        return view('billing.edit', compact('billing', 'clients', 'appointments'));
    }

    public function update(Request $request, Billing $billing)
    {
        $validated = $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'sale_type' => 'required|in:Servicio,Producto',
            'appointment_id' => 'nullable|exists:appointments,id',
            'total_amount' => 'required|integer|min:0',
            'payment_method' => 'required|in:Débito,Crédito,Efectivo',
            'payment_date' => 'required|date',
            'status' => 'required|in:Pendiente,Pagado,Cancelado',
        ]);

        $billing->update($validated);

        return redirect()->route('billing.index')->with('success', 'Factura actualizada correctamente.');
    }

    public function destroy(Billing $billing)
    {
        $billing->delete();
        return redirect()->route('billing.index')->with('success', 'Factura eliminada.');
    }
}
