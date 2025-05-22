@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-primary">
                <i class="bi bi-person-badge me-2"></i>Détails de l'utilisateur
            </h4>
            <div>
                <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary me-2">
                    <i class="bi bi-pencil-square"></i> Modifier
                </a>
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="bi bi-person-lines-fill me-2"></i>Informations personnelles
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-person-circle fs-1 
                                        @if($user->role == 'admin') text-danger
                                        @elseif($user->role == 'medecin') text-primary
                                        @else text-secondary
                                        @endif"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5>{{ $user->name }}</h5>
                                    <p class="mb-1">
                                        <i class="bi bi-envelope me-1"></i> 
                                        {{ $user->email }}
                                    </p>
                                    <p class="mb-0">
                                        <span class="badge 
                                            @if($user->role == 'admin') bg-danger
                                            @elseif($user->role == 'medecin') bg-primary
                                            @else bg-secondary
                                            @endif">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="bi bi-clock-history me-2"></i>Activité
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h6 class="text-muted">Date de création</h6>
                                <p>
                                    <i class="bi bi-calendar-plus me-2"></i>
                                    {{ $user->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            
                            <div class="mb-3">
                                <h6 class="text-muted">Dernière modification</h6>
                                <p>
                                    <i class="bi bi-calendar-check me-2"></i>
                                    {{ $user->updated_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection