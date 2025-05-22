@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-primary">
                <i class="bi bi-journal-medical me-2"></i>Détails de la Consultation
            </h4>
            <div>
                <a href="{{ route('consultations.edit', $consultation->id) }}" class="btn btn-outline-primary me-2">
                    <i class="bi bi-pencil-square"></i> Modifier
                </a>
                <a href="{{ route('consultations.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="bi bi-person me-2"></i>Patient
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-person-circle fs-1 text-primary"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5>{{ $consultation->patient->nom }} {{ $consultation->patient->prenom }}</h5>
                                    @if($consultation->patient->date_naissance)
                                    <p class="mb-1">
                                        <i class="bi bi-calendar me-1"></i> 
                                        {{ \Carbon\Carbon::parse($consultation->patient->date_naissance)->format('d/m/Y') }}
                                        ({{ \Carbon\Carbon::parse($consultation->patient->date_naissance)->age }} ans)
                                    </p>
                                    @endif
                                    @if($consultation->patient->telephone)
                                    <p class="mb-0">
                                        <i class="bi bi-telephone me-1"></i> 
                                        {{ $consultation->patient->telephone }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="bi bi-heart-pulse me-2"></i>Médecin
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-person-badge fs-1 text-danger"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5>Dr. {{ $consultation->medecin->nom }} {{ $consultation->medecin->prenom }}</h5>
                                    @if($consultation->medecin->specialite)
                                    <p class="mb-1">
                                        <i class="bi bi-briefcase me-1"></i> 
                                        {{ $consultation->medecin->specialite }}
                                    </p>
                                    @endif
                                    @if($consultation->medecin->service)
                                    <p class="mb-0">
                                        <i class="bi bi-building me-1"></i> 
                                        {{ $consultation->medecin->service }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="bi bi-calendar-date me-2"></i>Informations Consultation
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h6 class="text-muted">Date</h6>
                                <p>
                                    <i class="bi bi-calendar-check me-2"></i>
                                    {{ \Carbon\Carbon::parse($consultation->date_consultation)->format('d/m/Y') }}
                                </p>
                            </div>
                            
                            <div class="mb-3">
                                <h6 class="text-muted">Motif</h6>
                                <p class="p-3 bg-light rounded">
                                    {{ $consultation->motif }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="bi bi-prescription2 me-2"></i>Traitement
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="p-3 bg-light rounded">
                                {!! nl2br(e($consultation->traitement)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($consultation->created_at || $consultation->updated_at)
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="text-muted small">
                        <p class="mb-0">
                            <i class="bi bi-clock-history me-1"></i>
                            Créé le : {{ $consultation->created_at->format('d/m/Y H:i') }}
                            @if($consultation->created_at != $consultation->updated_at)
                                | Modifié le : {{ $consultation->updated_at->format('d/m/Y H:i') }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection