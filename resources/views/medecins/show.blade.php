@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2><i class="bi bi-person-lines-fill text-primary"></i> Détails du Médecin</h2>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('medecins.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">{{ $medecin->nom }} {{ $medecin->prenom }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Spécialité :</strong> {{ $medecin->specialite->nom ?? '-' }}</p>
            <p><strong>Email :</strong> {{ $medecin->email ?? '-' }}</p>
            <p><strong>Téléphone :</strong> {{ $medecin->telephone ?? '-' }}</p>
            <p><strong>Créé le :</strong> {{ $medecin->created_at->format('d/m/Y') }}</p>
            <p><strong>Dernière mise à jour :</strong> {{ $medecin->updated_at->format('d/m/Y') }}</p>
        </div>
    </div>
</div>
@endsection
