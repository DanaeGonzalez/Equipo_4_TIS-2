<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\ClinicalRecord;
use App\Models\Medication;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function create($clinicalRecordId)
    {
        $clinicalRecord = ClinicalRecord::findOrFail($clinicalRecordId);
        $medications = Medication::all();

        return view('tenant.prescriptions.create', compact('clinicalRecord', 'medications'));
    }

    public function store(Request $request, $clinicalRecordId)
    {
        $request->validate([
            'medication_id' => 'required|exists:medications,id',
            'dosage' => 'required|string',
            'duration' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        Prescription::create([
            'clinical_record_id' => $clinicalRecordId,
            'medication_id' => $request->medication_id,
            'dosage' => $request->dosage,
            'duration' => $request->duration,
            'notes' => $request->notes,
        ]);

        return redirect()->route('clinical_records.edit', $clinicalRecordId)->with('success', 'Prescripción añadida correctamente.');
    }

    public function edit(Prescription $prescription)
    {
        $medications = Medication::all();
        return view('tenant.prescriptions.edit', compact('prescription', 'medications'));
    }

    public function update(Request $request, Prescription $prescription)
    {
        $request->validate([
            'medication_id' => 'required|exists:medications,id',
            'dosage' => 'required|string',
            'duration' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $prescription->update($request->all());

        return redirect()->route('clinical_records.edit', $prescription->clinical_record_id)->with('success', 'Prescripción actualizada.');
    }

    public function destroy(Prescription $prescription)
    {
        $clinicalRecordId = $prescription->clinical_record_id;
        $prescription->delete();

        return redirect()->route('clinical_records.edit', $clinicalRecordId)->with('success', 'Prescripción eliminada.');
    }
}
