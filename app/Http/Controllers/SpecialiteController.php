<?php

namespace App\Http\Controllers;

use App\Models\Specialite;
use Illuminate\Http\Request;

class SpecialiteController extends Controller
{
    /**
     * Affiche la liste avec recherche.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $specialites = Specialite::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nom', 'like', "%{$search}%");
            })
            ->paginate(5);

        return view('specialites.index', compact('specialites', 'search'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        return view('specialites.create');
    }

    /**
     * Enregistrement d'une spécialité.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|unique:specialites,nom',
        ]);

        Specialite::create($request->only('nom'));

        return redirect()->route('specialites.index')->with('success', 'Spécialité ajoutée avec succès.');
    }

    /**
     * Formulaire d'édition.
     */
    public function edit(Specialite $specialite)
    {
        return view('specialites.edit', compact('specialite'));
    }

    /**
     * Mise à jour d'une spécialité.
     */
    public function update(Request $request, Specialite $specialite)
    {
        $request->validate([
            'nom' => 'required|string|unique:specialites,nom,' . $specialite->id,
        ]);

        $specialite->update($request->only('nom'));

        return redirect()->route('specialites.index')->with('success', 'Spécialité mise à jour.');
    }

    /**
     * Suppression d'une spécialité.
     */
    public function destroy(Specialite $specialite)
    {
        $specialite->delete();

        return redirect()->route('specialites.index')->with('success', 'Spécialité supprimée.');
    }
}
