<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supply;
use App\Models\Supplier;

class SupplierController extends Controller
{
    
    public function create()
    {
        return view('tenant.supplier.create');
    }

    public function storeFromProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_name'=> 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:12',
            'address' => 'nullable|string|max:255',
        ]);

        $supplier = Supplier::create($validated);

        return redirect()->route('products.create' )->withInput()->with('new_supplier_id', $supplier->id);
    }

    public function storeFromSupply(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_name'=> 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:12',
            'address' => 'nullable|string|max:255',
        ]);

        $supplier = Supplier::create($validated);

        return redirect()->route('supplies.create' )->withInput()->with('new_supplier_id', $supplier->id);
    }
}
