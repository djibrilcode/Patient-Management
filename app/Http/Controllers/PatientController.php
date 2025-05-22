<?php 

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        // Initialisation de la requête sur le modèle Patient
        $patients = Patient::query();

        // Récupération de la valeur de la recherche
        $search = $request->input('search');

        if ($search) {
            // Recherche multicritère sur nom, prénom et téléphone
            $patients->where(function ($query) use ($search) {
                $query->where('nom', 'like', "%{$search}%")
                      ->orWhere('prenom', 'like', "%{$search}%")
                      ->orWhere('telephone', 'like', "%{$search}%");
            });
        }

        // Pagination des résultats (5 patients par page)
        $patients = $patients->paginate(5);

        // Retourner la vue avec les patients filtrés
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        Patient::create($request->all());
        return redirect()->route('patients.index')->with('success', 'Patient ajouté avec succès');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $patient->update($request->all());
        return redirect()->route('patients.index')->with('success', 'Patient mis à jour avec succès');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient supprimé avec succès');
    }
}
