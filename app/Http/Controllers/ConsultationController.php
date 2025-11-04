<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Patient;
use App\Models\Medecin;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    // Afficher la liste des consultations
    public function index(Request $request)
    {
        $query = Consultation::with(['patient', 'medecin'])
            ->when($request->search, function($q, $search) {
                $q->whereHas('patient', fn($q2) =>
                        $q2->where('nom', 'like', "%{$search}%")
                           ->orWhere('prenom', 'like', "%{$search}%")
                           ->orWhere('telephone', 'like', "%{$search}%")
                           ->orwhere('motif', 'like', "%{$search}%")
                    )
                  ->orWhereHas('medecin', fn($q2) =>
                        $q2->where('nom', 'like', "%{$search}%")
                           ->orWhere('prenom', 'like', "%{$search}%")
                    );
            });

        $consultations = $query
            ->latest()
            ->paginate(5)
            ->appends($request->only('search'));

        return view('consultations.index', compact('consultations'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $patients = Patient::all();
        $medecins = Medecin::all();

        return view('consultations.create', compact('patients', 'medecins'));
    }

    // Enregistrer une nouvelle consultation
    public function store(Request $request)
{
    $request->validate([
        'patient_id' => 'required|exists:patients,id',
        'medecin_id' => 'required|exists:medecins,id',
        'date_consultation' => 'required|date',  // Ici on modifie `date` en `date_consultation`
        'motif' => 'required|string',
        'traitement' => 'required|string',
    ]);

    // Création de la consultation
    Consultation::create([
        'patient_id' => $request->patient_id,
        'medecin_id' => $request->medecin_id,
        'date_consultation' => $request->date_consultation,  // Utilisation de `date_consultation`
        'motif' => $request->motif,
        'traitement' => $request->traitement,
    ]);

    // Redirection après création
    return redirect()->route('consultations.index')->with('success', 'Consultation créée avec succès');
}


    // Afficher les détails d'une consultation
  public function show(Consultation $consultation)
{
    // Chargement des relations pour éviter les requêtes N+1
    $consultation->load(['patient', 'medecin']);
    
    return view('consultations.show', compact('consultation'));
}

    // Afficher le formulaire d'édition
    public function edit(Consultation $consultation)
    {
        $patients = Patient::all();
        $medecins = Medecin::all();

        return view('consultations.edit', compact('consultation', 'patients', 'medecins'));
    }

    // Mettre à jour la consultation
    public function update(Request $request, Consultation $consultation)
    {
        // $request->validate([
        //     'patient_id' => 'required|exists:patients,id',
        //     'medecin_id' => 'required|exists:medecins,id',
        //     'date' => 'required|date',
        //     'heure' => 'required|date_format:H:i',
        //     'statut' => 'required|string',
        // ]);

        $consultation->update($request->all());

        return redirect()->route('consultations.index')->with('success', 'Consultation mise à jour avec succès');
    }

    // Supprimer la consultation
    public function destroy(Consultation $consultation)
    {
        $consultation->delete();

        return redirect()->route('consultations.index')->with('success', 'Consultation supprimée avec succès');
    }
}
