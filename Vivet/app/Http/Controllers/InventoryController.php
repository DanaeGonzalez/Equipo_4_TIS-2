<?php

namespace App\Http\Controllers;

use App\Models\InventoryMovement;
use App\Models\User;
use App\Models\Product;
use App\Models\Supply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = InventoryMovement::query()->with('user');

        // Filtros opcionales
        if ($request->filled('movement_type')) {
            $query->where('movement_type', $request->movement_type);
        }

        if ($request->filled('item_type')) {
            $query->where('item_type', $request->item_type);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $movements = $query->latest()->paginate(20);

        return view('tenant.dashboard.modules.inventory.index', compact('movements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $supplies = Supply::all();

        $items = $products->merge($supplies);

        return view('tenant.dashboard.modules.inventory.movement-form', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_type' => 'required|in:App\Models\Product,App\Models\Supply',
            'item_id' => 'required|integer',
            'movement_type' => 'required|in:entrada,salida',
            'unit_type' => 'required|in:unidad,caja',
            'quantity' => 'required|integer|min:1',
            'units_per_box' => 'nullable|integer|min:1',
        ]);

        $finalQuantity = $request->unit_type === 'caja'
            ? $request->quantity * $request->units_per_box
            : $request->quantity;

        InventoryMovement::create([
            'item_type' => $request->item_type,
            'item_id' => $request->item_id,
            'movement_type' => $request->movement_type,
            'quantity' => $finalQuantity,
            'reason' => $request->reason,
            'user_id' => Auth::id(),
        ]);

        // Actualizar stock en Supply o Product
        $item = $request->item_type::find($request->item_id);
        if ($request->movement_type === 'entrada') {
            $item->stock += $finalQuantity;
        } else {
            $item->stock -= $finalQuantity;
        }
        $item->save();

        return redirect()->back()->with('success', 'Movimiento registrado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryMovement $inventoryMovement) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventoryMovement $inventoryMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * Aún n estpy segura si debería ir o no
     */
    public function update(Request $request, InventoryMovement $inventoryMovement)
    {
        $validated = $request->validate([
            'item_type' => 'required|in:App\Models\Product,App\Models\Supply',
            'item_id' => 'required|integer',
            'movement_type' => 'required|in:entrada,salida',
            'unit_type' => 'required|in:unidad,caja',
            'quantity' => 'required|integer|min:1',
            'units_per_box' => 'nullable|integer|min:1',
        ]);
        $inventoryMovement->update($validated);
        return redirect()->route('inventory.index')->with('success', 'Inventario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    /*public function destroy(InventoryMovement $inventoryMovement)
    {
        //
    }*/

    public function storeForProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string',
        ]);

        InventoryMovement::updateOrCreate([
            'item_type' => 'producto',
            'item_id' => $request->product_id,
            'movement_type' => 'entrada',
            'quantity' => $request->quantity,
            'reason' => $request->reason,
            'user_id' => $user?->id ?? auth()->id(),
        ]);

        // Actualizar stock real del producto
        $product = Product::find($request->product_id);
        $product->stock += $request->quantity;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Stock inicial registrado.');
    }
}
