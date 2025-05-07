<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'estimated_duration' => 'required|integer|max:255',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('images/clients/client1/services', 'public');
        }

        Service::create($validated);

        return redirect()->route('services.index')->with('success', 'Servicio creado correctamente.');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'estimated_duration' => 'required|integer|max:255',
            'icon' => 'nullable|string|max:255',
            //'is_active' => 'nullable|boolean', //activar una vez que tenga arreglada la migración
        ]);

        //$validated['is_active'] = $request->has('is_active');
        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'Servicio actualizado.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Servicio eliminado.');
    }
}
