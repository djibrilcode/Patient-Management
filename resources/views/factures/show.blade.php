@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-file-invoice"></i> Facture #FAC-{{ str_pad($facture->id_facture, 6, '0', STR_PAD_LEFT) }}
            </h4>
            <div>
                <a href="{{ route('factures.edit', $facture->id) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i> Modifier
                </a>
                <a href="{{ route('factures.index') }}" class="btn btn-sm btn-secondary ms-2">
                    <i class="fas fa-list"></i> Retour à la liste
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 border-left-primary">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                <i class="fas fa-user-injured"></i> Informations Patient
                            </h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Nom:</strong> {{ $facture->consultation->patient->nom }}</p>
                                    <p><strong>Prénom:</strong> {{ $facture->consultation->patient->prenom }}</p>
                                    <p><strong>CIN:</strong> {{ $facture->consultation->patient->cin ?? 'Non renseigné' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Téléphone:</strong> {{ $facture->consultation->patient->telephone }}</p>
                                    <p><strong>Email:</strong> {{ $facture->consultation->patient->email ?? 'Non renseigné' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 border-left-success">
                        <div class="card-body">
                            <h5 class="card-title text-success">
                                <i class="fas fa-file-invoice-dollar"></i> Détails Facture
                            </h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Date création:</strong> {{ $facture->created_at->format('d/m/Y H:i') }}</p>
                                    <p><strong>Montant:</strong> {{ number_format($facture->montant, 2) }} DH</p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <strong>Statut:</strong> 
                                        @if($facture->statut_paiement == 'payé')
                                            <span class="badge bg-success">Payé</span>
                                        @elseif($facture->statut_paiement == 'partiel')
                                            <span class="badge bg-warning text-dark">Partiel</span>
                                        @else
                                            <span class="badge bg-danger">Impayé</span>
                                        @endif
                                    </p>
                                    <p>
                                        <strong>Mode paiement:</strong> 
                                        {{ $facture->mode_paiement ? ucfirst($facture->mode_paiement) : 'Non spécifié' }}
                                    </p>
                                    @if($facture->date_paiement)
                                        <p><strong>Date paiement:</strong> {{ $facture->date_paiement->format('d/m/Y') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-left-info mb-4">
                <div class="card-body">
                    <h5 class="card-title text-info">
                        <i class="fas fa-calendar-check"></i> Détails Consultation
                    </h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Date consultation:</strong> {{ $facture->consultation->date_consultation->format('d/m/Y H:i') }}</p>
                            <p><strong>Médecin:</strong> Dr. {{ $facture->consultation->medecin->nom ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Diagnostic:</strong> {{ $facture->consultation->diagnostic ?? 'Non renseigné' }}</p>
                            <p><strong>Traitement:</strong> {{ $facture->consultation->traitement ?? 'Non renseigné' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-success me-2" onclick="window.print()">
                    <i class="fas fa-print"></i> Imprimer
                </button>
                <a href="{{ route('factures.export', ['facture' => $facture->id, 'format' => 'pdf']) }}" 
   class="btn btn-primary">
    <i class="fas fa-file-pdf"></i> Exporter PDF
</a>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .card, .card * {
            visibility: visible;
        }
        .card {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none;
            box-shadow: none;
        }
        .no-print {
            display: none !important;
        }
    }
</style>
@endsection