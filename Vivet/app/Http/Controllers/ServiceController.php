<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $role = Auth::user()->user_type;
        return view('tenant.services.index', compact('services','role'));
    }

    public function create()
    {
        return view('tenant.services.create');
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
            $file = $request->file('icon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/clients/client1/services');

            /*if (!file_exists($destinationPath)) { //aún no sé si es necesario
                mkdir($destinationPath, 0755, true);
            }*/

            $file->move($destinationPath, $filename);
            $validated['icon'] = 'images/clients/client1/services/' . $filename;
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
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/clients/client1/services');

            /* Crear el directorio si no existe
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }*/

            if ($request->hasFile('icon')) { //corrobora si existe un archivo anterior
                if ($service->icon && file_exists(public_path($service->icon))) {
                    unlink(public_path($service->icon));
                }


                $file = $request->file('icon');
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('images/clients/client1/services');
            }
            $file->move($destinationPath, $filename);
            $validated['icon'] = 'images/clients/client1/services/' . $filename;
        }
        $validated['is_active'] = $request->has('is_active');
        $service->update($validated);
        return redirect()->route('services.index')->with('success', 'Servicio actualizado.');
    }

    public function destroy(Service $service)
    {
        $service->update(['is_active' => false]);
        return redirect()->route('services.index')->with('success', 'Servicio desactivado.');
    }
}
