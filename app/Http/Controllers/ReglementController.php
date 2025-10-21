<?php

namespace App\Http\Controllers;

use App\Models\Reglement;
use App\Models\Facture;
use Illuminate\Http\Request;

class ReglementController extends Controller
{
    public function index()
    {
        $reglements = Reglement::with('facture.consultation.patient')->latest()->paginate(10);
        return view('reglements.index', compact('reglements'));
    }

    public function create()
    {
        $factures = Facture::where('statut_paiement', '!=', 'payé')->get();
        return view('reglements.create', compact('factures'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'facture_id' => 'required|exists:factures,id',
            'montant' => 'required|numeric|min:0',
            'mode_paiement' => 'required|in:espèce,carte,chèque,virement',
            'date_paiement' => 'required|date',
        ]);

        $reglement = Reglement::create($request->all());

        // Mise à jour du statut de la facture
        $facture = $reglement->facture;
        $totalRegle = $facture->reglements()->sum('montant');
        if ($totalRegle >= $facture->montant) {
            $facture->statut_paiement = 'payé';
        } elseif ($totalRegle > 0) {
            $facture->statut_paiement = 'partiel';
        }
        $facture->save();

        return redirect()->route('reglements.index')->with('success', 'Règlement enregistré avec succès.');
    }

    public function destroy(Reglement $reglement)
    {
        $facture = $reglement->facture;
        $reglement->delete();

        // Mise à jour du statut de la facture
        $totalRegle = $facture->reglements()->sum('montant');
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
