<?php

namespace App\Http\Controllers;

use App\Models\ClinicalRecord;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ClinicalRecordController extends Controller
{
    public function index()
    {
        $records = ClinicalRecord::with(['pet.client', 'vet'])
            ->orderBy('date', 'desc')
            ->paginate(10); // Paginar para que funcione con $pagination

        $columns = ['Fecha', 'Mascota', 'Peso', 'Cliente', 'Veterinario'];

        $rows = collect($records->items())->map(function ($record) {
            return [
                'id' => $record->id,
                'columns' => [
                    $record->date->format('d-m-Y'),               // Fecha formateada
                    $record->pet->pet_name ?? 'Sin nombre',       // Mascota
                    $record->weight . ' kg',                      // Peso con unidad
                    $record->pet->client->name ?? 'Sin cliente',  // Cliente
                    $record->vet->name ?? 'Sin veterinario',      // Veterinario
                ],
            ];
        });

        return view('tenant.dashboard.modules.clinical_records.index', [
            'columns' => $columns,
            'rows' => $rows,
            'pagination' => $records,
        ]);
    }


    public function create()
    {
        $pets = Pet::all();
        return view('tenant.dashboard.modules.clinical_records.create', compact('pets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'date' => 'required|date',
            'weight' => 'nullable|numeric',
            'temperature' => 'nullable|numeric',
            'symptoms' => 'required|string',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        try {
            ClinicalRecord::create([
                'pet_id' => $request->pet_id,
                'vet_id' => auth()->id(),
                'date' => $request->date,
                'weight' => $request->weight,
                'temperature' => $request->temperature,
                'symptoms' => $request->symptoms,
                'diagnosis' => $request->diagnosis,
                'treatment' => $request->treatment,
                'notes' => $request->notes,
            ]);

            return redirect()->route('clinical_records.index')->with('success', 'Ficha clínica registrada correctamente.');
        } catch (Exception $e) {
            Log::error('Error al guardar ficha clínica: ' . $e->getMessage());
            return back()->withErrors(['general' => 'Ocurrió un error al guardar la ficha.']);
        }
    }

    public function edit(ClinicalRecord $clinicalRecord)
    {
        $pets = Pet::all();
        return view('tenant.dashboard.modules.clinical_records.edit', compact('clinicalRecord', 'pets'));
    }

    public function update(Request $request, ClinicalRecord $clinicalRecord)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'date' => 'required|date',
            'weight' => 'nullable|numeric',
            'temperature' => 'nullable|numeric',
            'symptoms' => 'required|string',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $clinicalRecord->update($request->all());

        return redirect()->route('clinical_records.index')->with('success', 'Ficha clínica actualizada correctamente.');
    }

    public function destroy(ClinicalRecord $clinicalRecord)
    {
        $clinicalRecord->delete();
        return redirect()->route('clinical_records.index')->with('success', 'Ficha clínica eliminada correctamente.');
    }

    public function show(ClinicalRecord $clinicalRecord)
    {
        // Carga relaciones necesarias para la vista
        $clinicalRecord->load(['pet.client', 'vet']);
        return view('tenant.dashboard.modules.clinical_records.show', compact('clinicalRecord'));
    }
}
