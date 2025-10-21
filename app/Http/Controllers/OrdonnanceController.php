<?php

namespace App\Http\Controllers;

use App\Models\Ordonnance;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrdonnanceController extends Controller
{
    public function index(Request $request)
    {
        $ordonnances = Ordonnance::with('prescription.patient', 'prescription.medecin')
            ->latest()
            ->paginate(10);

        return view('ordonnances.index', compact('ordonnances'));
    }

public function show(Ordonnance $ordonnance)
{
    // Charge en une seule requête toutes les relations nécessaires
    $ordonnance->load([
        'prescription.medecin', 
        'prescription.patient', 
        'prescription.medicaments' => function ($query) {
            $query->withPivot('dosage', 'duree'); // Force le chargement des champs pivot
        }
    ]);

    return view('ordonnances.show', compact('ordonnance'));
}


    public function create()
    {
        $prescriptions = Prescription::doesntHave('ordonnance')->get();
        return view('ordonnances.create', compact('prescriptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prescription_id' => 'required|exists:prescriptions,id',
            'numero' => 'required|unique:ordonnances,numero',
            'date_emission' => 'required|date',
            'date_validite' => 'nullable|date|after_or_equal:date_emission',
        ]);

        Ordonnance::create($validated);

        return redirect()->route('ordonnances.index')->with('success', 'Ordonnance créée avec succès.');
    }
    public function edit(Ordonnance $ordonnance)
{
    $prescriptions = Prescription::doesntHave('ordonnance')->orWhere('id', $ordonnance->prescription_id)->get();

    return view('ordonnances.edit', compact('ordonnance', 'prescriptions'));
}

public function update(Request $request, Ordonnance $ordonnance)
{
    $validated = $request->validate([
        'prescription_id' => 'required|exists:prescriptions,id',
        'numero' => "required|unique:ordonnances,numero,{$ordonnance->id}",
        'date_emission' => 'required|date',
        'date_validite' => 'nullable|date|after_or_equal:date_emission',
    ]);

    $ordonnance->update($validated);

    return redirect()->route('ordonnances.index')->with('success', 'Ordonnance mise à jour avec succès.');
}


    public function destroy(Ordonnance $ordonnance)
{
    $ordonnance->delete();
    return redirect()->route('ordonnances.index')->with('success', 'Ordonnance supprimée avec succès.');
}


public function downloadPdf(Ordonnance $ordonnance)
{
    $ordonnance->load('prescription.medecin', 'prescription.patient', 'prescription.medicaments');

    $pdf = Pdf::loadView('ordonnances.pdf', compact('ordonnance'));

    return $pdf->download("ordonnance_{$ordonnance->numero}.pdf");
}
}
