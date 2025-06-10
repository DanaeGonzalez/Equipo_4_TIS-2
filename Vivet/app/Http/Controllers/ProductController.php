<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\InventoryMovement;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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
        return view('tenant.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'is_active' => 'nullable|boolean',
            'category' => 'required|string|in:Comida,Vacunas,Medicamentos,Accesorios,Suplementos',
            //'is_vaccine' => 'nullable|boolean',
            /*'vaccine_species' => 'nullable|string|required_if:category===Comida',
            'validity_period' => 'nullable|integer|required_if:is_vaccine,1',*/
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'is_active' => $validated['is_active'],
            'category' => $validated['category'],
            //'is_vaccine' => $request->input('is_vaccine') == '1',
        ]);
        //dd($request->all());

        if ($validated['stock'] > 0) {
            InventoryMovement::create([
                'item_type' => 'producto',
                'item_id' => $product->id,
                'movement_type' => 'entrada',
                'quantity' => $validated['stock'],
                'reason' => $request->input('stock_reason'),
                'user_id' => auth()->id(),
            ]);
        }
        /* cambiar
        if ($request->input('is_vaccine') == '1') {
            Vaccine::create([
                'product_id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'species' => $validated['vaccine_species'],
                'validity_period' => $validated['validity_period'],
            ]);
        }*/

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
        /* return redirect()->route('products.index')->with([
            'new_product_id' => $product->id,
            'open_stock_modal' => true,
        ]); */
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
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'is_active' => 'nullable|boolean',
            'category' => 'required|string|in:Comida,Vacunas,Medicamentos, Accesorios, Suplementos',
            //'is_vaccine' => 'nullable|boolean',
            /*'vaccine_species' => 'nullable|string|required_if:is_vaccine,1',
            'validity_period' => 'nullable|integer|required_if:is_vaccine,1',*/
        ]);

        /*$isVaccine = $request->boolean('is_vaccine');
        $isVaccine = $validated->category==='Vacuna'*/

        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'is_active' => $request->boolean('is_active'),
            'category' => $validated['category'],
            //'is_vaccine' => $request->boolean('is_vaccine'),

        ]);


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
        return view('tenant.products.adjustStock', compact('product'));
    }

    public function adjustStock(Request $request, Product $product)
    {
        $request->validate([
            'movement_type' => ['required', Rule::in(['entrada', 'salida'])],
            'quantity' => 'required|integer|min:1',
            'reason' => 'required|string|max:255',
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

        InventoryMovement::create([
            'item_type' => 'producto',
            'item_id' => $product->id,
            'movement_type' => $request->movement_type,
            'quantity' => abs($request->quantity),
            'reason' => $request->reason,
            'user_id' => auth()->id(),
        ]);

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
