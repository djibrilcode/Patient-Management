<?php

namespace App\Http\Controllers;

use App\Models\Dossiers_medicaux;
use App\Models\Patient;
use App\Models\Medecin;
use Illuminate\Http\Request;

class DossiersMedicauxController extends Controller
{
   public function index(Request $request)
{
    $query = Dossiers_medicaux::with(['patient', 'medecin']);

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->whereHas('patient', function ($q) use ($search) {
            $q->where('nom', 'like', "%$search%")
              ->orWhere('prenom', 'like', "%$search%");
        });
    }

    $dossiers = $query->paginate(10);
    return view('dossiers.index', compact('dossiers'));
}


    public function create()
    {
        $patients = Patient::doesntHave('dossierMedical')->get();
        $medecins = Medecin::all();
        return view('dossiers.create', compact('patients', 'medecins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id|unique:dossiers_medicaux,patient_id',
            'antecedents_personnels' => 'nullable|string',
            'antecedents_familiaux' => 'nullable|string',
            'allergies' => 'nullable|string',
            'traitements_chroniques' => 'nullable|string',
            'habitudes' => 'nullable|string',
            'remarques' => 'nullable|string',
            'medecin_id' => 'nullable|exists:medecins,id',
        ]);

        Dossiers_medicaux::create($request->all());

        return redirect()->route('dossiers.index')->with('success', 'Dossier médical créé avec succès.');
    }

    public function show(Dossiers_medicaux $dossier)
    {
        return view('dossiers.show', compact('dossier'));
    }

    public function edit(Dossiers_medicaux $dossier)
    {
        $patients = Patient::all();
        $medecins = Medecin::all();
        return view('dossiers.edit', compact('dossier', 'patients', 'medecins'));
    }

    public function update(Request $request, Dossiers_medicaux $dossier)
    {
        $request->validate([
            'antecedents_personnels' => 'nullable|string',
            'antecedents_familiaux' => 'nullable|string',
            'allergies' => 'nullable|string',
            'traitements_chroniques' => 'nullable|string',
            'habitudes' => 'nullable|string',
            'remarques' => 'nullable|string',
            'medecin_id' => 'nullable|exists:medecins,id',
        ]);

        $dossier->update($request->all());

        return redirect()->route('dossiers.index')->with('success', 'Dossier mis à jour.');
    }

    public function destroy(Dossiers_medicaux $dossier)
    {
        $dossier->delete();
        return redirect()->route('dossiers.index')->with('success', 'Dossier supprimé.');
    }
}
