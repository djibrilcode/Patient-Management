<?php

namespace App\Http\Controllers;

use App\Models\Rendezvous;
use App\Models\Patient;
use App\Models\Medecin;
use App\Models\Specialite;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RendezvousController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $rendezvous = Rendezvous::with(['patient', 'medecin.specialite'])
            ->when($search, function ($query, $search) {
                $query->whereHas('patient', function ($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%")
                      ->orWhere('prenom', 'like', "%{$search}%")
                      ->orWhere('telephone', 'like', "%{$search}%");
                })->orWhereHas('medecin', function ($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%")
                      ->orWhere('prenom', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(5)
            ->appends(['search' => $search]);

        return view('rendezvous.index', compact('rendezvous', 'search'));
    }

    public function create()
    {
        $patients = Patient::all();
        $medecins = Medecin::with('specialite')->get();
        return view('rendezvous.create', compact('patients', 'medecins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medecin_id' => 'required|exists:medecins,id',
            'date' => 'required|date',
            'heure' => ['required', 'date_format:H:i'],
            'statut' => 'required|in:prévu,annulé,terminé,confirmé,en attente',
            'motif' => 'nullable|string',
        ]);

        $conflit = Rendezvous::where('medecin_id', $request->medecin_id)
            ->where('date', $request->date)
            ->where('heure', $request->heure)
            ->exists();

        if ($conflit) {
            return back()->withInput()->withErrors([
                'heure' => 'Ce médecin est déjà occupé à cette date et heure.',
            ]);
        }

        Rendezvous::create($request->all());

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous créé avec succès.');
    }

    public function show($id)
    {
        $rendezvous = Rendezvous::with(['patient', 'medecin.specialite'])->findOrFail($id);
        return view('rendezvous.show', compact('rendezvous'));
    }

    public function edit(Rendezvous $rendezvous)
    {
        $patients = Patient::all();
        $medecins = Medecin::with('specialite')->get();
        return view('rendezvous.edit', compact('rendezvous', 'patients', 'medecins'));
    }

    public function update(Request $request, Rendezvous $rendezvous)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medecin_id' => 'required|exists:medecins,id',
            'date' => 'required|date',
            'heure' => ['required', 'date_format:H:i'],
            'statut' => 'required|in:prévu,annulé,terminé,confirmé,en attente',
            'motif' => 'nullable|string',
        ]);

        $conflit = Rendezvous::where('medecin_id', $request->medecin_id)
            ->where('date', $request->date)
            ->where('heure', $request->heure)
            ->where('id', '!=', $rendezvous->id)
            ->exists();

        if ($conflit) {
            return back()->withInput()->withErrors([
                'heure' => 'Ce médecin est déjà occupé à cette date et heure.',
            ]);
        }

        $rendezvous->update($request->all());

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous mis à jour.');
    }

    public function destroy(Rendezvous $rendezvous)
    {
        $rendezvous->delete();
        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous supprimé.');
    }

    public function recu($id)
    {
        $rendezvous = Rendezvous::with(['patient', 'medecin'])->findOrFail($id);
        $pdf = PDF::loadView('rendezvous.recu_pdf', compact('rendezvous'));
        return $pdf->download('recu-rdv-' . $rendezvous->id . '.pdf');
    }

    public function calendar()
    {
        $rendezvous = Rendezvous::with('medecin', 'patient')
            ->whereIn('statut', ['prévu', 'annulé', 'terminé'])
            ->get();

        $events = $rendezvous->map(function ($rdv) {
            return [
                'id' => $rdv->id,
                'title' => $rdv->patient->prenom . ' ' . $rdv->patient->nom . ' - Dr. ' . $rdv->medecin->nom,
                'start' => $rdv->date . 'T' . $rdv->heure,
                'color' => $rdv->statut === 'confirmé' ? '#28a745' : '#ffc107',
            ];
        });

        return view('rendezvous.calendar', compact('events'));
    }
}