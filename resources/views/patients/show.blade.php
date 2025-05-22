@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-primary">
                <i class="bi bi-person-lines-fill me-2"></i>Détails du Patient
            </h4>
            <div>
                <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-outline-primary me-2">
                    <i class="bi bi-pencil-square"></i> Modifier
                </a>
                <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0">
                            <i class="bi bi-person-circle fs-1 text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <div class="flex-grow-1 ms-4">
                            <h2 class="mb-1">{{ $patient->prenom }} {{ $patient->nom }}</h2>
                            <div class="d-flex flex-wrap">
                                <span class="badge bg-light text-dark me-2 mb-2">
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ \Carbon\Carbon::parse($patient->date_naissance)->age }} ans
                                </span>
                                @if($patient->email)
                                <span class="badge bg-light text-dark me-2 mb-2">
                                    <i class="bi bi-envelope me-1"></i>
                                    {{ $patient->email }}
                                </span>
                                @endif
                                @if($patient->telephone)
                                <span class="badge bg-light text-dark mb-2">
                                    <i class="bi bi-telephone me-1"></i>
                                    {{ $patient->telephone }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="bi bi-house-door me-2"></i>Adresse
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $patient->adresse }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="bi bi-info-circle me-2"></i>Informations supplémentaires
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h6 class="text-muted">Date de naissance</h6>
                                <p>
                                    <i class="bi bi-calendar-date me-2"></i>
                                    {{ \Carbon\Carbon::parse($patient->date_naissance)->format('d/m/Y') }}
                                </p>
                            </div>
                            
                            <div class="mb-3">
                                <h6 class="text-muted">Date d'enregistrement</h6>
                                <p>
                                    <i class="bi bi-clock-history me-2"></i>
                                    {{ $patient->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            
                            @if($patient->created_at != $patient->updated_at)
                            <div class="mb-3">
                                <h6 class="text-muted">Dernière mise à jour</h6>
                                <p>
                                    <i class="bi bi-arrow-repeat me-2"></i>
                                    {{ $patient->updated_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border: none;
        border-radius: 10px;
    }
    
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    .badge {
        padding: 0.35em 0.65em;
        font-weight: 500;
    }
</style>
@endsection