<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\InventoryMovement;
use App\Models\Medication;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;
use App\Models\PurchaseDetail;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $role = Auth::user()->user_type;
        return view('tenant.products.index', compact('products', 'role'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('tenant.products.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer',
            'is_active' => 'nullable|boolean',
            'category' => 'required|string|in:Comida,Vacunas,Medicamentos,Accesorios,Suplementos',
            'vaccine_species' => 'nullable|string|required_if:category,Vacunas',
            'validity_period' => 'nullable|integer|required_if:category,Vacunas',
            'dosage_instructions' => 'nullable|string|required_if:category,Medicamentos',
            'supplier_id' => 'required_if:stock,>0|exists:suppliers,id',
            'unit_cost' => 'required_if:stock,>0|numeric|min:0',
            'invoice_number' => 'nullable|string',
            //'purchase_date' => 'required|date',
            'total_cost'=> 'required|integer',
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'is_active' => $request->boolean('is_active'),
            'category' => $validated['category'],
        ]);
        //dd($request->all());

        if ($validated['stock'] > 0) {
            $movement = InventoryMovement::create([
                'item_type' => 'producto',
                'item_id' => $product->id,
                'movement_type' => 'entrada',
                'quantity' => $validated['stock'],
                'reason' => $request->input('stock_reason'),
                'user_id' => auth()->id(),
            ]);

            PurchaseDetail::create([
                'inventory_movement_id' => $movement->id,
                'supplier_id' => $validated['supplier_id'],
                'quantity' => $validated['stock'],
                'unit_cost' => $validated['unit_cost'],
                'total_cost' => $validated['unit_cost'] * $validated['stock'],
                'purchase_date' => now(),
                'invoice_number' => $request->invoice_number,
            ]);
        }


        if ($request->input('category') == 'Vacunas') {
            Vaccine::create([
                'product_id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'species' => $validated['vaccine_species'],
                'validity_period' => $validated['validity_period'],
            ]);
        }

        if ($request->input('category') == 'Medicamentos') {
            Medication::create([
                'product_id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'dosage_instructions' => $validated['dosage_instructions'],

            ]);
        }

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
    }
    public function edit(Product $product)
    {
        $vaccine = Vaccine::where('product_id', $product->id)->first();
        return view('tenant.products.edit', compact('product', 'vaccine'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer',
            'is_active' => 'nullable|boolean',
            'category' => 'required|string|in:Comida,Vacunas,Medicamentos,Accesorios,Suplementos',
            //'is_vaccine' => 'nullable|boolean',
            'vaccine_species' => 'nullable|string|required_if:category,Vacunas',
            'validity_period' => 'nullable|integer|required_if:category,Vacunas',
            'dosage_instructions' => 'nullable|string|required_if:category,Medicamentos',
        ]);

        /*$isVaccine = $request->boolean('is_vaccine');*/
        $isVaccine = $request->input('category') == 'Vacunas';
        $isMedication = $request->input('category') == 'Medicamentos';

        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'is_active' => $request->boolean('is_active'),
            'category' => $validated['category'],
            //'is_vaccine' => $request->boolean('is_vaccine'),

        ]);

        if ($isVaccine) {
            Vaccine::updateOrCreate(
                ['product_id' => $product->id],
                [
                    'name' => $product->name,
                    'description' => $product->description,
                    'species' => $validated['vaccine_species'] ?? null,
                    'validity_period' => $validated['validity_period'] ?? null,
                ]
            );
        } else {
            Vaccine::where('product_id', $product->id)->delete();
        }

        if ($isMedication) {
            Medication::updateOrCreate([
                'product_id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'dosage_instructions' => $validated['dosage_instructions'] ?? null,

            ]);
        } else {
            Medication::where('product_id', $product->id)->delete();
        }

        /*if ($isVaccine) {
            Vaccine::updateOrCreate(
                ['product_id' => $product->id],
                [
                    'name' => $product->name,
                    'description' => $product->description,
                    'species' => $validated['vaccine_species'],
                    'validity_period' => $validated['validity_period'],
                ]
            );
        } else {
            Vaccine::where('product_id', $product->id)->delete();
        }*/
        return redirect()->route('products.index')->with('success', 'Producto actualizado.');
    }
    //Modificar desde aqui
    public function destroy(Product $product)
    {
        $product->update(['is_active' => false]);
        return redirect()->route('products.index')->with('success', 'Producto desactivado.');
    }

    public function showAdjustForm(Product $product)
    {
        $suppliers = Supplier::all();
        return view('tenant.products.adjustStock', compact('product', 'suppliers'));
    }

    public function adjustStock(Request $request, Product $product)
    {
        $request->validate([
            'movement_type' => ['required', Rule::in(['entrada', 'salida'])],
            'quantity' => 'required|integer|min:1',
            'reason' => 'required|string|max:255',
            'supplier_id' => 'required_if:movement_type,entrada|exists:suppliers,id',
            'unit_cost' => 'required_if:movement_type,entrada|numeric|min:0',
        ]);

        $quantity = $request->quantity;

        if ($request->movement_type === 'salida') {
            $quantity = -$quantity;
        }

        $newStock = $product->stock + $quantity;

        if ($newStock < 0) {
            return back()->with('error', 'No hay suficiente stock para esta salida.');
        }

        $product->stock = $newStock;
        $product->save();

        $movement = InventoryMovement::create([
            'item_type' => 'producto',
            'item_id' => $product->id,
            'movement_type' => $request->movement_type,
            'quantity' => abs($request->quantity),
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

        return redirect()->route('products.index')->with('success', 'Movimiento de stock registrado.');
    }

    public function movements(Product $product)
    {
        $movements = InventoryMovement::where('item_type', 'producto')
            ->where('item_id', $product->id)
            ->latest()
            ->get();

        return view('tenant.products.movements', compact('product', 'movements'));
    }
}
