@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg mx-auto" style="max-width: 750px; border-radius: 1rem;">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="bi bi-capsule-pill me-2"></i> Détails du Médicament</h3>
            <a href="{{ route('medicaments.edit', $medicament->id) }}" class="btn btn-light btn-sm fw-bold shadow-sm hover-scale">
                <i class="bi bi-pencil-square me-1"></i> Éditer
            </a>
        </div>
        <div class="card-body">
            <div class="mb-4 text-center">
                <i class="bi bi-capsule-pill text-primary" style="font-size: 3rem;"></i>
                <h4 class="mt-2">{{ $medicament->nom }}</h4>
            </div>

            <div class="mb-4">
                <h5 class="text-success"><i class="bi bi-card-text me-2"></i>Description</h5>
                <p class="ms-3">
                    @if($medicament->description)
                        {{ $medicament->description }}
                    @else
                        <span class="text-muted fst-italic">Aucune description fournie</span>
                    @endif
                </p>
            </div>

            <div class="row text-center">
                <div class="col-md-6 mb-3">
                    <span class="badge bg-info fs-6">
                        <i class="bi bi-plus-circle me-1"></i> Créé le : {{ $medicament->created_at->format('d/m/Y H:i') }}
                    </span>
                </div>
                <div class="col-md-6 mb-3">
                    <span class="badge bg-warning text-dark fs-6">
                        <i class="bi bi-pencil-square me-1"></i> Mis à jour le : {{ $medicament->updated_at->format('d/m/Y H:i') }}
                    </span>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('medicaments.index') }}" class="btn btn-secondary shadow-sm hover-scale">
                    <i class="bi bi-arrow-left me-1"></i> Retour à la liste
                </a>
                
                <form action="{{ route('medicaments.destroy', $medicament->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce médicament ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger shadow-sm hover-scale">
                        <i class="bi bi-trash me-1"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Styles personnalisés --}}
@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0d6efd, #198754);
    }

    .hover-scale {
        transition: transform 0.2s ease-in-out;
    }

    .hover-scale:hover {
        transform: scale(1.05);
    }

    .card-body h5 {
        border-bottom: 2px solid #198754;
        display: inline-block;
        padding-bottom: 4px;
    }
</style>
@endpush
@endsection
