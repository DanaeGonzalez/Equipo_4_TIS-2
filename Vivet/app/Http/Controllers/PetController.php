<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Client;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::select('id', 'pet_name', 'species', 'color', 'sex', 'client_id')
            ->with('client:id,name')
            ->paginate(10);

        $columns = ['Nombre', 'Especie', 'Color', 'Sexo', 'Cliente'];
        $rows = collect($pets->items())->map(function ($pet) {
            return [
                'id' => $pet->id,
                'columns' => [
                    $pet->pet_name,
                    $pet->species,
                    $pet->color,
                    $pet->sex,
                    $pet->client?->name ?? 'Sin cliente',
                ],
            ];
        });

        return view('tenant.dashboard.modules.pets.index', [
            'columns' => $columns,
            'rows' => $rows,
            'pagination' => $pets, // Para usar {{ $pagination->links() }}
        ]);
    }


    public function create()
    {
        $clients = Client::all();
        return view('tenant.dashboard.modules.pets.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'pet_name' => 'required',
            'species' => 'required',
            'color' => 'required',
            'sex' => 'required|in:Macho,Hembra',
        ]);

        Pet::create($request->all());

        return redirect()->route('pets.index')->with('success', 'Mascota creada exitosamente.');
    }

    public function show(Pet $pet)
    {
        return view('tenant.dashboard.modules.pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        $clients = Client::all();
        return view('tenant.dashboard.modules.pets.edit', compact('pet', 'clients'));
    }

    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'pet_name' => 'required',
            'species' => 'required',
            'color' => 'required',
            'sex' => 'required|in:Macho,Hembra',
        ]);

        $pet->update($request->all());

        return redirect()->route('pets.index')->with('success', 'Mascota actualizada correctamente.');
    }

    public function destroy(Pet $pet)
    {
        if ($pet->status === 'Fallecido') {
            return redirect()->route('pets.index')->with('info', 'Esta mascota ya está marcada como fallecida.');
        }

        $pet->update(['status' => 'Fallecido']);

        return redirect()->route('pets.index')->with('success', 'La mascota ha sido marcada como fallecida.');
    }
}
