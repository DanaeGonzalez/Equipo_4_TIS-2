<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use App\Models\InventoryMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Supplier;
use App\Models\PurchaseDetail;

class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Supply::orderBy('name');
        if ($request->has('search') && $request->search !== '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $supplies = $query->get();
        return view('tenant.supplies.index', compact('supplies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('tenant.supplies.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:supplies',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'stock_reason' => 'nullable|string',
            'units_per_box' => 'nullable|integer|min:1', //si la unidad de medidas son cajas, lo necesita
            'unit_type' => ['required', Rule::in(['unidades', 'cajas'])],
            'supplier_id' => 'required_if:stock,>0|exists:suppliers,id',
            'unit_cost' => 'required_if:stock,>0|numeric|min:0',
        ]);

        $validated['unit_type'] = strtolower($validated['unit_type']);
        $totalStockUnits = $validated['stock'];

        if ($validated['unit_type'] === 'cajas' && !empty($validated['units_per_box'])) {
            $totalStockUnits = $validated['stock'] * $validated['units_per_box'];
        }
        $validated['stock'] = $totalStockUnits;

        $supply = Supply::create(array_merge($validated, ['is_active' => true]));
        if ($validated['stock'] > 0) {
            $movement = InventoryMovement::create([
                'item_type' => 'insumo',
                'item_id' => $supply->id,
                'movement_type' => 'entrada',
                'quantity' => $totalStockUnits,
                'reason' => $validated['stock_reason'] ?? 'Stock inicial',
                'user_id' => auth()->id(),
            ]);

            PurchaseDetail::create([
                'inventory_movement_id' => $movement->id,
                'supplier_id' => $validated['supplier_id'],
                'unit_cost' => $validated['unit_cost'],
                'purchase_date' => now(),
            ]);
        }

        return redirect()->route('supplies.index')->with('success', 'Insumo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supply $supply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supply $supply)
    {
        return view('tenant.supplies.edit', compact('supply'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supply $supply)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('supplies')->ignore($supply->id)],
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            /*'unit_type' => ['required', Rule::in(['unidades', 'cajas'])],
            'units_per_box' => 'nullable|integer|min:1|required_if:unit,cajas',*/
        ]);

        $supply->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'is_active' => $request->input('is_active'),
            /*'unit_type' => $request->input('unit'),
            'units_per_box' => $request->input('units_per_box'),*/
        ]);

        return redirect()->route('supplies.index')->with('success', 'Insumo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supply $supply)
    {
        $supply->update(['is_active' => false]);

        return redirect()->route('supplies.index')->with('success', 'Insumo no disponible.');
    }

    public function adjustStock(Request $request, Supply $supply)
    {
        $request->validate([
            'movement_type' => ['required', Rule::in(['entrada', 'salida'])],
            'quantity' => 'required|integer|min:1',
            'unit_type' => ['required', Rule::in(['unidades', 'cajas'])],
            'reason' => 'required|string|max:255',
            'supplier_id' => 'required_if:movement_type,entrada|exists:suppliers,id',
            'unit_cost' => 'required_if:movement_type,entrada|numeric|min:0',
        ]);

        $quantity = $request->quantity;

        // Convertir cajas a unidades si es necesario
        if ($request->unit_type === 'cajas') {
            if (!$supply->units_per_box || $supply->units_per_box < 1) {
                return back()->with('error', 'Este insumo no tiene unidades por caja definidas.');
            }
            $quantity *= $supply->units_per_box;
        }

        if ($request->movement_type === 'salida') {
            $quantity = -$quantity;
        }

        $newStock = $supply->stock + $quantity;

        if ($newStock < 0) {
            return back()->with('error', 'No hay suficiente stock para esta salida.');
        }

        $supply->stock = $newStock;
        $supply->is_active = $newStock > 0;
        $supply->save();

        $movement = InventoryMovement::create([
            'item_type' => 'insumo',
            'item_id' => $supply->id,
            'movement_type' => $request->movement_type,
            'quantity' => abs($quantity),
            'reason' => $request->reason,
            'user_id' => auth()->id(),
        ]);

        if ($request->movement_type === 'entrada') {
            PurchaseDetail::create([
                'inventory_movement_id' => $movement->id,
                'supplier_id' => $request->supplier_id,
                'unit_cost' => $request->unit_cost,
                'purchase_date' => now(),
            ]);
        }

        return redirect()->route('supplies.index')->with('success', 'Movimiento de inventario registrado.');
    }

    public function movements(Supply $supply) //Sirve para ver cuantos movimientos ha tenido el insumo (inventario más a detalle)
    {
        $movements = InventoryMovement::where('item_type', 'insumo')
            ->where('item_id', $supply->id)
            ->latest()
            ->get();

        return view('tenant.supplies.movements', compact('supply', 'movements'));
    }

    public function showAdjustForm(Supply $supply)
    {
        $suppliers = Supplier::all();
        return view('tenant.supplies.adjustStock', compact('supply','suppliers'));
    }
}
