@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h4 class="fw-bold mb-4">🔍 Détail du document</h4>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <p><strong>ID :</strong> {{ $document->id }}</p>
            <p><strong>Patient :</strong> {{ $document->patient->nom ?? '-' }} {{ $document->patient->prenom ?? '' }}</p>
            <p><strong>Titre :</strong> {{ $document->titre }}</p>
            <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($document->date)->format('d/m/Y') }}</p>
            <p><strong>Fichier :</strong> 
                <a href="{{ route('documents.download', $document->id) }}" class="btn btn-sm btn-outline-success">
                    <i class="fas fa-download"></i> Télécharger
                </a>
            </p>
        </div>
        <div class="card-footer">
            <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-secondary">
                <i class="fas fa-edit me-1"></i> Modifier
            </a>
            <a href="{{ route('documents.index') }}" class="btn btn-primary ms-2">Retour</a>
        </div>
    </div>
</div>
@endsection
