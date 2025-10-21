<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Medecin;
use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Medicament;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index(Request $request)
    {
        $prescriptions = Prescription::with(['medecin', 'patient', 'consultation'])
            ->when($request->search, function ($query, $search) {
                $query->whereHas('patient', function ($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%")
                      ->orWhere('prenom', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('prescriptions.index', compact('prescriptions'));
    }

    public function create()
    {
        $medecins = Medecin::all();
        $patients = Patient::all();
        $consultations = Consultation::all();
        $medicaments = Medicament::all();

        return view('prescriptions.create', compact('medecins', 'patients', 'consultations', 'medicaments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'medecin_id' => 'required|exists:medecins,id',
            'patient_id' => 'required|exists:patients,id',
            'consultation_id' => 'nullable|exists:consultations,id',
            'date_prescription' => 'required|date',
            'instructions' => 'nullable|string',
            'medicaments' => 'nullable|array',
            'medicaments.*.dosage' => 'nullable|string|max:255',
            'medicaments.*.duree' => 'nullable|string|max:255',
        ]);

        // Création prescription
        $prescription = Prescription::create([
            'medecin_id' => $validated['medecin_id'],
            'patient_id' => $validated['patient_id'],
            'consultation_id' => $validated['consultation_id'] ?? null,
            'date_prescription' => $validated['date_prescription'],
            'instructions' => $validated['instructions'] ?? null,
        ]);

        // Association meds pivot
        if (!empty($validated['medicaments'])) {
            $attachData = [];
            foreach ($validated['medicaments'] as $medId => $medData) {
                if (!empty($medData['dosage']) || !empty($medData['duree'])) {
                    $attachData[$medId] = [
                        'dosage' => $medData['dosage'] ?? null,
                        'duree' => $medData['duree'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            if (!empty($attachData)) {
                $prescription->medicaments()->attach($attachData);
            }
        }

        return redirect()->route('prescriptions.index')->with('success', 'Prescription enregistrée avec succès.');
    }

    public function show(Prescription $prescription)
    {
        $prescription->load(['medecin', 'patient', 'consultation', 'medicaments']);

        return view('prescriptions.show', compact('prescription'));
    }

    public function edit(Prescription $prescription)
    {
        $medecins = Medecin::all();
        $patients = Patient::all();
        $consultations = Consultation::all();
        $medicaments = Medicament::all();

        $prescription->load('medicaments');

        return view('prescriptions.edit', compact('prescription', 'medecins', 'patients', 'consultations', 'medicaments'));
    }

    public function update(Request $request, Prescription $prescription)
    {
        $validated = $request->validate([
            'medecin_id' => 'required|exists:medecins,id',
            'patient_id' => 'required|exists:patients,id',
            'consultation_id' => 'nullable|exists:consultations,id',
            'date_prescription' => 'required|date',
            'instructions' => 'nullable|string',
            'medicaments' => 'nullable|array',
            'medicaments.*.dosage' => 'nullable|string|max:255',
            'medicaments.*.duree' => 'nullable|string|max:255',
        ]);

        $prescription->update([
            'medecin_id' => $validated['medecin_id'],
            'patient_id' => $validated['patient_id'],
            'consultation_id' => $validated['consultation_id'] ?? null,
            'date_prescription' => $validated['date_prescription'],
            'instructions' => $validated['instructions'] ?? null,
        ]);

        // Détacher tous meds liés
        $prescription->medicaments()->detach();

        // Réattacher si meds présents
        if (!empty($validated['medicaments'])) {
            $attachData = [];
            foreach ($validated['medicaments'] as $medId => $medData) {
                if (!empty($medData['dosage']) || !empty($medData['duree'])) {
                    $attachData[$medId] = [
                        'dosage' => $medData['dosage'] ?? null,
                        'duree' => $medData['duree'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            if (!empty($attachData)) {
                $prescription->medicaments()->attach($attachData);
            }
        }

        return redirect()->route('prescriptions.index')->with('success', 'Prescription mise à jour avec succès.');
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();

        return redirect()->route('prescriptions.index')->with('success', 'Prescription supprimée avec succès.');
    }
}
