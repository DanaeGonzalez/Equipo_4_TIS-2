<?php

namespace App\Http\Controllers;

use App\Models\ClinicalRecord;
use Illuminate\Http\Request;

class ClinicalHistoryController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $allowedRoles = ['Admin', 'Veterinario'];

        $query = ClinicalRecord::with(['pet.client', 'vet']);

        // FILTRO por nombre de cliente
        if ($request->filled('client_name')) {
            $query->whereHas('pet.client', function ($q) use ($request) {
                $q->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ['%' . $request->client_name . '%']);
            });
        }

        // FILTRO por nombre de mascota
        if ($request->filled('pet_name')) {
            $query->whereHas('pet', function ($q) use ($request) {
                $q->where('pet_name', 'LIKE', '%' . $request->pet_name . '%');
            });
        }

        // FILTRO por fecha
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('date', [$request->from_date, $request->to_date]);
        }

        $records = $query->orderBy('date', 'desc')->paginate(20);

        return view('tenant.dashboard.modules.clinical_history.index', compact('records'));
    }

}
