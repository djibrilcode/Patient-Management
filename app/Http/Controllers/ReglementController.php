<?php

namespace App\Http\Controllers;

use App\Models\Reglement;
use App\Models\Facture;
use Illuminate\Http\Request;

class ReglementController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $mode = $request->input('mode');
        $from = $request->input('from');
        $to = $request->input('to');

        $reglements = Reglement::with('facture.consultation.patient')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('facture.consultation.patient', function ($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%")
                      ->orWhere('prenom', 'like', "%{$search}%");
                });
            })
            ->when($mode, fn($q) => $q->where('mode', $mode))
            ->when($from, fn($q) => $q->whereDate('date_reglement', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('date_reglement', '<=', $to))
            ->latest()
            ->paginate(10)
            ->appends($request->query());

        return view('reglements.index', compact('reglements'));
    }

   public function create()
{
    $factures = Facture::withSum('reglements', 'montant_regle')->get()->map(function ($f) {
        $f->restant = $f->montant - $f->reglements_sum_montant_regle;
        return $f;
    });

    return view('reglements.create', compact('factures'));
}


    public function store(Request $request)
    {
        $request->validate([
            'facture_id' => 'required|exists:factures,id',
            'montant_regle' => 'required|numeric|min:0',
            'mode' => 'required|in:espèce,carte,chèque,virement,mynita,amanata',
            'date_reglement' => 'required|date',
        ]);

        $reglement = Reglement::create($request->all());

        // 🔄 Mise à jour du statut de la facture
        $facture = $reglement->facture;
        $totalRegle = $facture->reglements()->sum('montant_regle');

        if ($totalRegle >= $facture->montant) {
            $facture->statut_paiement = 'payé';
        } elseif ($totalRegle > 0) {
            $facture->statut_paiement = 'partiel';
        } else {
            $facture->statut_paiement = 'impayé';
        }

        $facture->save();
        $facture = $reglement->facture;
$facture->statut_paiement = $facture->calculerStatut();
$facture->save();


        return redirect()->route('reglements.index')->with('success', 'Règlement enregistré avec succès.');
    }

    public function show(Reglement $reglement)
    {
        return view('reglements.show', compact('reglement'));
    }

    public function edit(Reglement $reglement)
    {
        return view('reglements.edit', compact('reglement'));
    }

    public function update(Request $request, Reglement $reglement)
    {
        $request->validate([
            'montant_regle' => 'required|numeric|min:0',
            'mode' => 'required|in:espèce,carte,chèque,virement,mynita,amanata',
            'date_reglement' => 'required|date',
        ]);

        $reglement->update($request->only(['montant_regle', 'mode', 'date_reglement']));

        // 🔄 Mise à jour du statut de la facture
        $facture = $reglement->facture;
        $totalRegle = $facture->reglements()->sum('montant_regle');

        if ($totalRegle >= $facture->montant) {
            $facture->statut_paiement = 'payé';
        } elseif ($totalRegle > 0) {
            $facture->statut_paiement = 'partiel';
        } else {
            $facture->statut_paiement = 'impayé';
        }
        $facture = $reglement->facture;
$facture->statut_paiement = $facture->calculerStatut();
$facture->save();


        $facture->save();

        return redirect()->route('reglements.index')->with('success', 'Règlement mis à jour avec succès.');
    }

    public function destroy(Reglement $reglement)
    {
        $facture = $reglement->facture;
        $reglement->delete();

        $totalRegle = $facture->reglements()->sum('montant_regle');

        if ($totalRegle == 0) {
            $facture->statut_paiement = 'impayé';
        } elseif ($totalRegle >= $facture->montant) {
            $facture->statut_paiement = 'payé';
        } else {
            $facture->statut_paiement = 'partiel';
        }

        $facture->save();

        return redirect()->route('reglements.index')->with('success', 'Règlement supprimé avec succès.');
    }
}
