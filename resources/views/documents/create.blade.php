@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h4 class="fw-bold mb-4">📂 Ajouter un nouveau document</h4>

    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label for="patient_id" class="form-label">Patient</label>
                <select name="patient_id" id="patient_id" class="form-select @error('patient_id') is-invalid @enderror">
                    <option value="">Sélectionner un patient</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ old('patient_id')==$patient->id ? 'selected' : '' }}>
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
                       value="{{ old('titre') }}" placeholder="Ex : Résultat d'analyse">
                @error('titre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="fichier" class="form-label">Fichier</label>
                <input type="file" name="fichier" id="fichier" class="form-control @error('fichier') is-invalid @enderror">
                @error('fichier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror"
                       value="{{ old('date') ?? date('Y-m-d') }}">
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Ajouter
            </button>
            <a href="{{ route('documents.index') }}" class="btn btn-secondary ms-2">Annuler</a>
        </div>
    </form>
</div>
@endsection
