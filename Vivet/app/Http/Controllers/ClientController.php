<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->paginate(10);
        return view('tenant.clients.index', compact('clients'));
    }

    public function create()
    {
        //$this->authorize('create', Client::class);
        return view('tenant.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'client_run' => 'required|string|unique:clients',
            'email' => 'required|email|unique:clients',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        Client::create($request->all());

        return redirect()->route('tenant.clients.index')->with('success', 'Cliente creado correctamente.');
    }

    public function storeFromBilling(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'client_run' => 'required|string|unique:clients,client_run',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:9',
            'address' => 'nullable|string',
        ]);

        $client = Client::create($validated);

        return redirect()->route('tenant.billing.create')->with('new_client_id', $client->id);
    }
}
