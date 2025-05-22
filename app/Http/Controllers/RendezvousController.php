<?php

namespace App\Http\Controllers;

use App\Models\Rendezvous;
use App\Models\Patient;
use App\Models\Medecin;
use Illuminate\Http\Request;

class RendezvousController extends Controller
{
    // Afficher la liste des rendez-vous
    public function index(Request $request)
    {
        $query = Rendezvous::with(['patient', 'medecin'])
            ->when($request->search, function($q, $search) {
                $q->whereHas('patient', fn($q2) =>
                        $q2->where('nom', 'like', "%{$search}%")
                           ->orWhere('prenom', 'like', "%{$search}%")
                           ->orWhere('telephone', 'like', "%{$search}%")
                    )
                  ->orWhereHas('medecin', fn($q2) =>
                        $q2->where('nom', 'like', "%{$search}%")
                           ->orWhere('prenom', 'like', "%{$search}%")
                    );
            });
    
        $rendezvous = $query
            ->latest()
            ->paginate(5)
            ->appends($request->only('search'));
    
        return view('rendezvous.index', compact('rendezvous'));
    }
    
    
    // Afficher le formulaire de création
    public function create()
    {
        $patients = Patient::all();
        $medecins = Medecin::all();

        return view('rendezvous.create', compact('patients', 'medecins'));
    }

    // Enregistrer un nouveau rendez-vous
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medecin_id' => 'required|exists:medecins,id',
            'date' => 'required|date',
            'heure' => 'required|date_format:H:i',
            'statut' => 'required|string',
        ]);

        Rendezvous::create($request->all());

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous créé avec succès');
    }

    // Afficher les détails d'un rendez-vous
    public function show($id)
    {
        $rendezvous = Rendezvous::with(['patient', 'medecin'])->findOrFail($id);

        return view('rendezvous.show', compact('rendezvous'));
    }

    // Afficher le formulaire d'édition
    public function edit(Rendezvous $rendezvous)
    {
        $patients = Patient::all();
        $medecins = Medecin::all();

        return view('rendezvous.edit', compact('rendezvous', 'patients', 'medecins'));
    }

    // Mettre à jour le rendez-vous
    public function update(Request $request, Rendezvous $rendezvous)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medecin_id' => 'required|exists:medecins,id',
            'date' => 'required|date',
            'heure' => 'required|date_format:H:i',
            'statut' => 'required|string',
        ]);

        $rendezvous->update($request->all());

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous mis à jour avec succès');
    }

    // Supprimer le rendez-vous
    public function destroy(Rendezvous $rendezvous)
    {
        $rendezvous->delete();

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous supprimé avec succès');
    }
}
