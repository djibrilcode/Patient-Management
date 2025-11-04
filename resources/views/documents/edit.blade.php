@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h4 class="fw-bold mb-4">✏️ Modifier le document</h4>

    <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label for="patient_id" class="form-label">Patient</label>
                <select name="patient_id" id="patient_id" class="form-select @error('patient_id') is-invalid @enderror">
                    <option value="">Sélectionner un patient</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ $document->patient_id==$patient->id ? 'selected' : '' }}>
                            {{ $patient->nom }} {{ $patient->prenom }}
                        </option>
                    @endforeach
                </select>
                @error('patient_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" name="titre" id="titre" class="form-control @error('titre') is-invalid @enderror"
                       value="{{ old('titre', $document->titre) }}">
                @error('titre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="fichier" class="form-label">Fichier actuel : <strong>{{ $document->fichier }}</strong></label>
                <input type="file" name="fichier" id="fichier" class="form-control @error('fichier') is-invalid @enderror">
                @error('fichier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror"
                       value="{{ old('date', $document->date) }}">
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-edit me-1"></i> Mettre à jour
            </button>
            <a href="{{ route('documents.index') }}" class="btn btn-secondary ms-2">Annuler</a>
        </div>
    </form>
</div>
@endsection
