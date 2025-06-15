<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supply;
use App\Models\PurchaseDetail;
use App\Models\InventoryMovement;


class PurchaseDetailController extends Controller
{
    public function index(Request $request)
    {
        $query = PurchaseDetail::query()->with(['inventoryMovement.item', 'supplier']);

        // Filtro por tipo de ítem (producto o insumo)
        if ($request->filled('item_type')) {
            $modelMap = [
                'producto' => Product::class,
                'insumo' => Supply::class,
            ];

            if (isset($modelMap[$request->item_type])) {
                $query->whereHas('inventoryMovement', function ($q) use ($modelMap, $request) {
                    $q->where('item_type', $modelMap[$request->item_type]);
                });
            }
        }

        // Filtro por fecha de compra
        if ($request->filled('from_date')) {
            $query->whereDate('purchase_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('purchase_date', '<=', $request->to_date);
        }

        $purchaseDetails = $query->latest()->paginate(20);

        return view('tenant.purchase-details.index', compact('purchaseDetails'));
    }



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
