<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\InventoryMovement;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $role = Auth::user()->user_type;
        return view('products.index', compact('products', 'role'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'is_vaccine' => 'nullable|boolean',
            'vaccine_species' => 'nullable|string|required_if:is_vaccine,1',
            'validity_period' => 'nullable|integer|required_if:is_vaccine,1',
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'is_active' => $validated['is_active'],
            'is_vaccine' => $request->has('is_vaccine'),
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
            if ($product->is_vaccine) {
                Vaccine::create([
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'species' => $validated['vaccine_species'],
                    'validity_period' => $validated['validity_period'],
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
        /* return redirect()->route('products.index')->with([
            'new_product_id' => $product->id,
            'open_stock_modal' => true,
        ]); */
    }
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Producto actualizado.');
    }
    public function destroy(Product $product)
    {
        $product->update(['is_active' => false]);
        return redirect()->route('products.index')->with('success', 'Producto desactivado.');
    }
}
