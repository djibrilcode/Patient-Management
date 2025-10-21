@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg mx-auto" style="max-width: 700px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-folder2-open me-2"></i> Dossier Médical de {{ $dossier->patient->nom ?? 'Inconnu' }} {{ $dossier->patient->prenom ?? '' }}</h4>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>👤 Patient :</strong> {{ $dossier->patient->nom ?? '' }} {{ $dossier->patient->prenom ?? '' }}</li>
                <li class="list-group-item"><strong>🩺 Médecin :</strong> {{ $dossier->medecin?->nom ?? 'Non assigné' }}</li>
                <li class="list-group-item"><strong>🩸 Allergies :</strong> {{ $dossier->allergies ?: 'Aucune' }}</li>
                <li class="list-group-item"><strong>📜 Antécédents personnels :</strong> {{ $dossier->antecedents_personnels ?: '—' }}</li>
                <li class="list-group-item"><strong>👨‍👩‍👧 Antécédents familiaux :</strong> {{ $dossier->antecedents_familiaux ?: '—' }}</li>
                <li class="list-group-item"><strong>💊 Traitements chroniques :</strong> {{ $dossier->traitements_chroniques ?: '—' }}</li>
                <li class="list-group-item"><strong>🚬 Habitudes :</strong> {{ $dossier->habitudes ?: '—' }}</li>
                <li class="list-group-item"><strong>📝 Remarques :</strong> {{ $dossier->remarques ?: '—' }}</li>
            </ul>

            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('dossiers.edit', $dossier) }}" class="btn btn-warning shadow-sm"><i class="bi bi-pencil-square me-1"></i> Modifier</a>
                <a href="{{ route('dossiers.index') }}" class="btn btn-secondary shadow-sm"><i class="bi bi-arrow-left-circle me-1"></i> Retour</a>
            </div>
        </div>
    </div>
</div>
@endsection
