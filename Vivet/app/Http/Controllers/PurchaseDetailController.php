<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supply;
use App\Models\PurchaseDetail;


class PurchaseDetailController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'inventory_movement_id' => 'required|exists:inventory_movements,id',
        'supplier_id' => 'required|exists:suppliers,id',
        'unit_cost' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:1',
        'invoice_number' => 'nullable|string',
        'purchase_date' => 'required|date',
    ]);

    $totalCost = $validated['unit_cost'] * $validated['quantity'];

    PurchaseDetail::create([
        'inventory_movement_id' => $validated['inventory_movement_id'],
        'supplier_id' => $validated['supplier_id'],
        'unit_cost' => $validated['unit_cost'],
        'total_cost' => $totalCost,
        'invoice_number' => $validated['invoice_number'],
        'purchase_date' => $validated['purchase_date'],
    ]);

    return redirect()->route('purchase-details.index')->with('success', 'Detalle de compra guardado correctamente.');
}

}
