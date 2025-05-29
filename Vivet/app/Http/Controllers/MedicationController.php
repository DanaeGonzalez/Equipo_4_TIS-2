<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    public function index()
    {
        $medications = Medication::all();
        return view('tenant.medications.index', compact('medications'));
    }

    public function create()
    {
        return view('tenant.medications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'dosage_instructions' => 'nullable|string',
        ]);

        Medication::create($request->all());

        return redirect()->route('medications.index')->with('success', 'Medicamento creado correctamente.');
    }

    public function edit(Medication $medication)
    {
        return view('tenant.medications.edit', compact('medication'));
    }

    public function update(Request $request, Medication $medication)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'dosage_instructions' => 'nullable|string',
        ]);

        $medication->update($request->all());

        return redirect()->route('medications.index')->with('success', 'Medicamento actualizado correctamente.');
    }

    public function destroy(Medication $medication)
    {
        $medication->delete();

        return redirect()->route('medications.index')->with('success', 'Medicamento eliminado correctamente.');
    }
}
