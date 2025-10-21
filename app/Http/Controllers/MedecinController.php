<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\Specialite;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $medecins = Medecin::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nom', 'like', "%{$search}%")
                      ->orWhere('prenom', 'like', "%{$search}%")
                      ->orWhere('telephone', 'like', "%{$search}%");
            })
            ->with('specialite')
            ->paginate(5);

        return view('medecins.index', compact('medecins', 'search'));
    }

    public function create()
    {
        $specialites = Specialite::all();
        return view('medecins.create', compact('specialites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email|unique:medecins',
            'specialite_id' => 'required|exists:specialites,id',
        ]);

        Medecin::create($request->all());
        return redirect()->route('medecins.index')->with('success', 'Médecin créé avec succès.');
    }

    public function show(Medecin $medecin)
    {
        return view('medecins.show', compact('medecin'));
    }

    public function edit(Medecin $medecin)
    {
        $specialites = Specialite::all();
        return view('medecins.edit', compact('medecin', 'specialites'));
    }

    public function update(Request $request, Medecin $medecin)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email|unique:medecins,email,' . $medecin->id,
            'specialite_id' => 'required|exists:specialites,id',
        ]);

        $medecin->update($request->all());
        return redirect()->route('medecins.index')->with('success', 'Médecin mis à jour.');
    }

    public function destroy(Medecin $medecin)
    {
        $medecin->delete();
        return redirect()->route('medecins.index')->with('success', 'Médecin supprimé.');
    }
}