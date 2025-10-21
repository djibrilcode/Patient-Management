@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm mx-auto" style="max-width: 900px;">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0">➕ Nouvelle Prescription</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('prescriptions.store') }}">
                @csrf

                <!-- Médecin et Patient en ligne -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="medecin_id" class="form-label">Médecin <span class="text-danger">*</span></label>
                        <select name="medecin_id" id="medecin_id" class="form-select @error('medecin_id') is-invalid @enderror" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($medecins as $medecin)
                                <option value="{{ $medecin->id }}" {{ old('medecin_id') == $medecin->id ? 'selected' : '' }}>
                                    {{ $medecin->nom }} {{ $medecin->prenom }}
                                </option>
                            @endforeach
                        </select>
                        @error('medecin_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="patient_id" class="form-label">Patient <span class="text-danger">*</span></label>
                        <select name="patient_id" id="patient_id" class="form-select @error('patient_id') is-invalid @enderror" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->nom }} {{ $patient->prenom }}
                                </option>
                            @endforeach
                        </select>
                        @error('patient_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Consultation et Date -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="consultation_id" class="form-label">Consultation (optionnel)</label>
                        <select name="consultation_id" id="consultation_id" class="form-select @error('consultation_id') is-invalid @enderror">
                            <option value="">-- Aucune --</option>
                            @foreach($consultations as $consult)
                                <option value="{{ $consult->id }}" {{ old('consultation_id') == $consult->id ? 'selected' : '' }}>
                                    Consultation #{{ $consult->id }} ({{ \Carbon\Carbon::parse($consult->date)->format('d/m/Y') }})
                                </option>
                            @endforeach
                        </select>
                        @error('consultation_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="date_prescription" class="form-label">Date de prescription <span class="text-danger">*</span></label>
                        <input type="date" name="date_prescription" id="date_prescription" class="form-control @error('date_prescription') is-invalid @enderror" value="{{ old('date_prescription') ?? now()->format('Y-m-d') }}" required>
                        @error('date_prescription')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Instructions -->
                <div class="mb-4">
                    <label for="instructions" class="form-label">Instructions</label>
                    <textarea name="instructions" id="instructions" class="form-control @error('instructions') is-invalid @enderror" rows="3">{{ old('instructions') }}</textarea>
                    @error('instructions')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Médicaments -->
                <h5 class="mb-3 text-success">Médicaments</h5>
                <div class="row g-3">
                    @foreach($medicaments as $medicament)
                        <div class="col-md-6">
                            <div class="card border-success shadow-sm p-3 h-100">
                                <strong class="text-success">{{ $medicament->nom }}</strong>
                                <input type="hidden" name="medicaments[{{ $medicament->id }}][id]" value="{{ $medicament->id }}">
                                <input type="text" name="medicaments[{{ $medicament->id }}][dosage]" class="form-control form-control-sm mt-2" placeholder="Dosage (ex: 2 comprimés/jour)" value="{{ old('medicaments.' . $medicament->id . '.dosage') }}">
                                <input type="text" name="medicaments[{{ $medicament->id }}][duree]" class="form-control form-control-sm mt-2" placeholder="Durée (ex: 5 jours)" value="{{ old('medicaments.' . $medicament->id . '.duree') }}">
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Boutons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('prescriptions.index') }}" class="btn btn-light">
                        ← Retour à la liste
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-2"></i> Enregistrer
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
