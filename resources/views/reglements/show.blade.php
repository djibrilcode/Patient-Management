@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- 🗂️ En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">🔍 Détails du Règlement #{{ $reglement->id }}</h4>
        <a href="{{ route('reglements.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Retour
        </a>
    </div>

    <!-- 📄 Carte du règlement -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            Informations sur le règlement
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h6 class="text-muted">Patient</h6>
                    <p class="fw-bold">{{ $reglement->facture->consultation->patient->nom ?? '-' }} {{ $reglement->facture->consultation->patient->prenom ?? '' }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted">Facture #</h6>
                    <p class="fw-bold">{{ $reglement->facture->id }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <h6 class="text-muted">Montant total facture</h6>
                    <p class="fw-bold">{{ number_format($reglement->facture->montant, 0, ',', ' ') }} F</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted">Montant déjà réglé</h6>
                    @php
                        $deja = $reglement->facture->reglements()->where('id', '!=', $reglement->id)->sum('montant_regle');
                    @endphp
                    <p class="fw-bold">{{ number_format($deja, 0, ',', ' ') }} F</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted">Reste à payer</h6>
                    @php
                        $reste = $reglement->facture->montant - $deja - $reglement->montant_regle;
                    @endphp
                    <p class="fw-bold text-danger">{{ number_format($reste, 0, ',', ' ') }} F</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <h6 class="text-muted">Montant réglé (ce paiement)</h6>
                    <p class="fw-bold">{{ number_format($reglement->montant_regle, 0, ',', ' ') }} F</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted">Mode de paiement</h6>
                    <p class="fw-bold">{{ ucfirst($reglement->mode) }}</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted">Date du règlement</h6>
                    <p class="fw-bold">{{ \Carbon\Carbon::parse($reglement->date_reglement)->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <h6 class="text-muted">Statut de la facture</h6>
                    @php
                        $status = $reglement->facture->statut_paiement;
                        $badgeClass = match($status) {
                            'payé' => 'bg-success',
                            'partiel' => 'bg-warning text-dark',
                            'impayé' => 'bg-danger',
                        };
                    @endphp
                    <span class="badge {{ $badgeClass }} px-3 py-2 rounded-pill">{{ ucfirst($status) }}</span>
                </div>
            </div>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('reglements.edit', $reglement->id) }}" class="btn btn-warning me-2">
                <i class="fas fa-edit me-1"></i> Modifier
            </a>
            <form action="{{ route('reglements.destroy', $reglement->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce règlement ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash me-1"></i> Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
