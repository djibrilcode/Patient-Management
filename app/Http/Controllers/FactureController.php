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
        // Requête de base avec les relations
        $query = Facture::with(['consultation.patient'])
            ->latest();
        
        // Clone de la requête pour les statistiques
        $statsQuery = clone $query;

        // Filtre de recherche
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('id_facture', 'like', "%$search%")
                  ->orWhereHas('consultation.patient', function($q) use ($search) {
                      $q->where('nom', 'like', "%$search%")
                        ->orWhere('prenom', 'like', "%$search%");
                  });
            });
        }

        // Filtre par statut
        if ($request->filled('statut')) {
            $statut = $request->statut;
            $query->where('statut_paiement', $statut);
        }

        // Filtre par mode
        if ($request->filled('mode')) {
            $mode = $request->mode;
            $query->where('mode_paiement', $mode);
        }

        // Filtre par date
        if ($request->filled('from')) {
            $from = $request->from;
            $query->whereDate('created_at', '>=', $from);
        }
        if ($request->filled('to')) {
            $to = $request->to;
            $query->whereDate('created_at', '<=', $to);
        }

        // Calcul des statistiques AVEC les mêmes filtres
        $stats = [
            'total' => (clone $query)->count(),
            'montant_total' => (clone $query)->sum('montant'),
            'impayes' => (clone $query)->where('statut_paiement', 'impayé')->count(),
            'retards' => (clone $query)->where('statut_paiement', '!=', 'payé')
                            ->whereDate('created_at', '<=', now()->subDays(30))
                            ->count()
        ];

        // Pagination des résultats
        $factures = $query->paginate(15);

        return view('factures.index', compact('factures', 'stats'));
    }

   public function create()
    {
        $consultations = Consultation::with('patient')
            ->whereDoesntHave('facture') // Correction: utilisez le nom de la relation définie dans le modèle
            ->get();
            
        return view('factures.create', compact('consultations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'consultation_id' => 'required|exists:consultations,id|unique:factures,consultation_id',
            'montant' => 'required|numeric|min:0',
            'statut_paiement' => 'required|in:payé,impayé,partiel',
            'mode_paiement' => 'required_if:statut_paiement,payé,partiel|nullable|in:espèce,carte,chèque,virement',
            'date_paiement' => 'required_if:statut_paiement,payé,partiel'
        ]);

        Facture::create($validated);

        return redirect()->route('factures.index')
            ->with('success', 'Facture créée avec succès!');
    }

  public function show($id_facture)
{
    $facture = Facture::findOrFail($id_facture);
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
            'mode_paiement' => 'required_if:statut_paiement,payé,partiel|nullable|in:espèce,carte,chèque,virement',
            'date_paiement' => 'required_if:statut_paiement,payé,partiel'
        ]));

         // Vérifier si le statut de paiement a changé

        return redirect()->route('factures.index')
            ->with('success', 'Facture mise à jour avec succès!');
    }

    public function destroy(Facture $facture)
    {
        $facture->delete();

        return redirect()->route('factures.index')
            ->with('success', 'Facture supprimée avec succès!');
    }

    // Méthode pour exporter les factures


public function export(Request $request)
{
    $validated = $request->validate([
        'format' => 'required|in:pdf,excel,csv',
        'export_from' => 'nullable|date',
        'export_to' => 'nullable|date|after_or_equal:export_from',
        'export_statut' => 'nullable|in:payé,impayé,partiel'
    ]);

    // Récupérer les factures filtrées
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

    // Créer le répertoire s'il n'existe pas
    $directory = storage_path('exports');
    if (!file_exists($directory)) {
        mkdir($directory, 0755, true);
    }

    $filename = 'factures_export_' . now()->format('Ymd_His') . '.pdf';
    $filepath = $directory . '/' . $filename;

    // Générer le PDF
    $pdf = Pdf::loadView('exports.factures_pdf', compact('factures'));
    $pdf->save($filepath);

    // Télécharger le fichier
    return response()->download($filepath)->deleteFileAfterSend(true);
}
}