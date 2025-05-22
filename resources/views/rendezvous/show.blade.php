@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-primary">
                <i class="bi bi-info-circle-fill me-2"></i>Détails du Rendez-vous
            </h4>
            <a href="{{ route('rendezvous.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="text-muted">Patient</h5>
                    <p>{{ $rendezvous->patient->nom }} {{ $rendezvous->patient->prenom }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="text-muted">Médecin</h5>
                    <p>{{ $rendezvous->medecin->nom }} {{ $rendezvous->medecin->prenom }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="text-muted">Date</h5>
                    <p>{{ \Carbon\Carbon::parse($rendezvous->date)->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="text-muted">Heure</h5>
                    <p>{{ $rendezvous->heure }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="text-muted">Statut</h5>
                    <span class="badge bg-info text-dark">{{ ucfirst($rendezvous->statut) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
