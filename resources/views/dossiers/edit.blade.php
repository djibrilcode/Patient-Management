@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg mx-auto" style="max-width: 700px;">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Modifier Dossier Médical</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('dossiers.update', $dossier) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="patient_id" class="form-label">Patient <span class="text-danger">*</span></label>
                    <select name="patient_id" class="form-select" required>
                        <option value="">-- Sélectionner --</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ $dossier->patient_id == $patient->id ? 'selected' : '' }}>
                                {{ $patient->nom }} {{ $patient->prenom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="medecin_id" class="form-label">Médecin (optionnel)</label>
                    <select name="medecin_id" class="form-select">
                        <option value="">-- Aucun --</option>
                        @foreach($medecins as $medecin)
                            <option value="{{ $medecin->id }}" {{ $dossier->medecin_id == $medecin->id ? 'selected' : '' }}>
                                Dr {{ $medecin->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @foreach(['antecedents_personnels', 'antecedents_familiaux', 'allergies', 'traitements_chroniques', 'habitudes', 'remarques'] as $field)
                    <div class="mb-3">
                        <label class="form-label">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                        <textarea name="{{ $field }}" class="form-control" rows="2">{{ old($field, $dossier->$field) }}</textarea>
                    </div>
                @endforeach

                <div class="d-flex justify-content-between mt-4">
                    <button class="btn btn-warning shadow-sm"><i class="bi bi-save me-1"></i> Mettre à jour</button>
                    <a href="{{ route('dossiers.index') }}" class="btn btn-secondary shadow-sm"><i class="bi bi-x-circle me-1"></i> Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
