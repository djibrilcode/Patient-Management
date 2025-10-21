@extends('layouts.app')

@section('content')
<div class="container my-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary"><i class="bi bi-file-medical-fill"></i> Ordonnance N°{{ $ordonnance->numero }}</h2>
        <a href="{{ route('ordonnances.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour aux ordonnances
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Informations générales</h5>
        </div>
        <div class="card-body">
            <p><strong>Médecin :</strong> {{ $ordonnance->prescription->medecin->nom }} {{ $ordonnance->prescription->medecin->prenom }}</p>
            <p><strong>Patient :</strong> {{ $ordonnance->prescription->patient->nom }} {{ $ordonnance->prescription->patient->prenom }}</p>
            <p><strong>Date d’émission :</strong> {{ \Carbon\Carbon::parse($ordonnance->date_emission)->format('d/m/Y') }}</p>
            <p><strong>Valide jusqu’au :</strong> 
                {{ $ordonnance->date_validite ? \Carbon\Carbon::parse($ordonnance->date_validite)->format('d/m/Y') : 'Non précisé' }}
            </p>
            <p><strong>Instructions :</strong><br> 
                {{ $ordonnance->prescription->instructions ?? 'Aucune instruction.' }}
            </p>
        </div>
    </div>

 <div class="card shadow-sm mb-4">
    <div class="card-header bg-light">
        <h5 class="mb-0">💊 Médicaments prescrits</h5>
    </div>
    <div class="card-body">
        @forelse ($ordonnance->prescription->medicaments as $medicament)
            <div class="mb-3 p-3 border rounded">
                <h6 class="fw-bold">{{ $medicament->nom }}</h6>
                <div class="row">
                    <div class="col-md-6">
                        <span class="text-muted">Dosage:</span>
                        <span class="ms-2">{{ $medicament->pivot->dosage ?? 'Non spécifié' }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted">Durée:</span>
                        <span class="ms-2">{{ $medicament->pivot->duree ?? 'Non spécifié' }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle"></i> Aucun médicament n'a été prescrit pour cette ordonnance.
            </div>
        @endforelse
    </div>
</div>

    <div class="text-end">
        <button onclick="window.print()" class="btn btn-outline-primary">
            <i class="bi bi-printer"></i> Imprimer
        </button>
        <a href="{{ route('ordonnances.pdf', $ordonnance) }}" class="btn btn-primary ms-2">
            <i class="bi bi-file-earmark-pdf"></i> Télécharger PDF
        </a>
    </div>
</div>

<style>
    /* Simple style pour impression */
    @media print {
        body * {
            visibility: hidden;
        }
        .container, .container * {
            visibility: visible;
        }
        .container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .btn {
            display: none !important;
        }
    }
</style>
@endsection
