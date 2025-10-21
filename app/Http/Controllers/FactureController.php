<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class FactureController extends Controller
{
 public function index(Request $request)
{
    $query = Facture::with(['consultation.patient'])->latest();

    // 🔍 Filtre de recherche
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('id', 'like', "%$search%")
              ->orWhereHas('consultation.patient', function ($q) use ($search) {
                  $q->where('nom', 'like', "%$search%")
                    ->orWhere('prenom', 'like', "%$search%");
              });
        });
    }

    // 🧾 Filtre par statut
    if ($request->filled('statut')) {
        $query->where('statut_paiement', $request->statut);
    }

    // 💳 Filtre par mode de paiement
    if ($request->filled('mode')) {
        $query->where('mode_paiement', $request->mode);
    }

    // 📅 Filtre par date
    if ($request->filled('from')) {
        $query->whereDate('created_at', '>=', $request->from);
    }

    if ($request->filled('to')) {
        $query->whereDate('created_at', '<=', $request->to);
    }

    // 📊 Statistiques globales
    $stats = [
        'total' => (clone $query)->count(),
        'montant_total' => (clone $query)->sum('montant'),
        'impayes' => (clone $query)->where('statut_paiement', 'impayé')->count(),
        'retards' => (clone $query)->where('statut_paiement', '!=', 'payé')
                        ->whereDate('created_at', '<=', now()->subDays(30))
                        ->count(),
    ];

    // 📄 Pagination (10 éléments par page)
    $factures = $query->paginate(10)->appends($request->query());

    return view('factures.index', compact('factures', 'stats'));
}


    public function create()
    {
        $consultations = Consultation::with('patient')->get();

        return view('factures.create', compact('consultations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'consultation_id' => 'required|exists:consultations,id|unique:factures,consultation_id',
            'montant' => 'required|numeric|min:0',
            'statut_paiement' => 'required|in:payé,impayé,partiel',
            'mode_paiement' => 'nullable|in:espèce,carte,chèque,virement,mynita,amanata',
            'date_paiement' => 'nullable|date'
        ]);

        Facture::create($validated);

        return redirect()->route('factures.index')
            ->with('success', 'Facture créée avec succès !');
    }

    public function show($id)
    {
        $facture = Facture::with(['consultation.patient'])->findOrFail($id);
        return view('factures.show', compact('facture'));
    }

    public function edit(Facture $facture)
    {
        $consultations = Consultation::with('patient')->get();
        return view('factures.edit', compact('facture', 'consultations'));
    }

    public function update(Request $request, Facture $facture)
    {
        $facture->update($request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'montant' => 'required|numeric|min:0',
            'statut_paiement' => 'required|in:payé,impayé,partiel',
            'mode_paiement' => 'nullable|in:espèce,carte,chèque,virement,mynita,amanata',
            'date_paiement' => 'nullable|date'
        ]));

        return redirect()->route('factures.index')
            ->with('success', 'Facture mise à jour avec succès !');
    }

    public function destroy(Facture $facture)
    {
        $facture->delete();

        return redirect()->route('factures.index')
            ->with('success', 'Facture supprimée avec succès !');
    }

    // 🔹 Export global
    public function export(Request $request)
    {
        $validated = $request->validate([
            'format' => 'required|in:pdf,excel,csv',
            'export_from' => 'nullable|date',
            'export_to' => 'nullable|date|after_or_equal:export_from',
            'export_statut' => 'nullable|in:payé,impayé,partiel'
        ]);

        $query = Facture::with(['consultation.patient']);

        if ($request->filled('export_from')) {
            $query->whereDate('created_at', '>=', $validated['export_from']);
        }

        if ($request->filled('export_to')) {
            $query->whereDate('created_at', '<=', $validated['export_to']);
        }

        if ($request->filled('export_statut')) {
            $query->where('statut_paiement', $validated['export_statut']);
        }

        $factures = $query->get();

        $pdf = Pdf::loadView('exports.factures_pdf', compact('factures'));
        return $pdf->download('Factures_Globales_' . now()->format('Ymd_His') . '.pdf');
    }

    // 🔹 Export individuel
   public function exportPdf(Facture $facture)
{
    $facture->load(['consultation.patient', 'consultation.medecin']);

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('exports.facture_single_pdf', compact('facture'))
        ->setPaper('a4', 'portrait');

    return $pdf->download('Facture_' . $facture->id_facture . '.pdf');
}

}
