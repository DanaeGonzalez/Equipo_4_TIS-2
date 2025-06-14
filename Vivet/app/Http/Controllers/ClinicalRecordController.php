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
        $records = ClinicalRecord::with(['pet', 'vet'])->orderBy('date', 'desc')->get();
        return view('tenant.clinical_records.index', compact('records'));
    }

    public function create()
    {
        $pets = Pet::all();
        return view('tenant.clinical_records.create', compact('pets'));
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
        return view('tenant.clinical_records.edit', compact('clinicalRecord', 'pets'));
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
        return view('tenant.clinical_records.show', compact('clinicalRecord'));
    }
    public function downloadPDF(ClinicalRecord $clinicalRecord)
    {
        // Cargamos las relaciones necesarias (igual que haces en show)
        $clinicalRecord->load(['pet.client', 'vet']);

        // Generamos el PDF usando el nuevo template profesional
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('tenant.pdf.clinical_records.show', compact('clinicalRecord'));

        return $pdf->stream('ficha_clinica_' . $clinicalRecord->pet->pet_name . '.pdf');
    }

}
