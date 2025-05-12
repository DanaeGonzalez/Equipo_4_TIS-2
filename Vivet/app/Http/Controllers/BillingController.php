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
            'client_id' => 'nullable|exists:clients,id',
            'sale_type' => 'required|in:Servicio,Producto',
            'appointment_id' => 'nullable|exists:appointments,id',
            'total_amount' => 'required|integer|min:0',
            'payment_method' => 'required|in:Débito,Crédito,Efectivo',
            'payment_date' => 'required|date',
            'status' => 'required|in:Pendiente,Pagado,Cancelado',
        ]);

        Billing::create($validated);

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