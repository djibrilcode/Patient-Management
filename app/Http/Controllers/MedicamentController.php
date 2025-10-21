<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use Illuminate\Http\Request;

class MedicamentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $medicaments = Medicament::query()
            ->when($search, function ($query, $search) {
                $query->where('nom', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('medicaments.index', compact('medicaments'));
    }

    public function create()
    {
        return view('medicaments.create');
    }

    public function show(Medicament $medicament)
    {
        return view('medicaments.show', compact('medicament'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Medicament::create($request->all());

        return redirect()->route('medicaments.index')->with('success', 'Médicament ajouté avec succès');
    }

    public function edit(Medicament $medicament)
    {
        return view('medicaments.edit', compact('medicament'));
    }

    public function update(Request $request, Medicament $medicament)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $medicament->update($request->all());

        return redirect()->route('medicaments.index')->with('success', 'Médicament mis à jour avec succès');
    }

    public function destroy(Medicament $medicament)
    {
        $medicament->delete();
        return redirect()->route('medicaments.index')->with('success', 'Médicament supprimé');
    }
}
