@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">✏️ Modifier Prescription #{{ $prescription->id }}</h4>
                    <a href="{{ route('prescriptions.index') }}" class="btn btn-light btn-sm">← Retour à la liste</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('prescriptions.update', $prescription) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="medecin_id" class="form-label">Médecin <span class="text-danger">*</span></label>
                                <select name="medecin_id" id="medecin_id" class="form-select @error('medecin_id') is-invalid @enderror" required>
                                    <option value="">-- Sélectionner --</option>
                                    @foreach($medecins as $medecin)
                                        <option value="{{ $medecin->id }}" {{ (old('medecin_id') ?? $prescription->medecin_id) == $medecin->id ? 'selected' : '' }}>
                                            {{ $medecin->nom }} {{ $medecin->prenom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('medecin_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4">
                                <label for="patient_id" class="form-label">Patient <span class="text-danger">*</span></label>
                                <select name="patient_id" id="patient_id" class="form-select @error('patient_id') is-invalid @enderror" required>
                                    <option value="">-- Sélectionner --</option>
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}" {{ (old('patient_id') ?? $prescription->patient_id) == $patient->id ? 'selected' : '' }}>
                                            {{ $patient->nom }} {{ $patient->prenom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('patient_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4">
                                <label for="consultation_id" class="form-label">Consultation (optionnel)</label>
                                <select name="consultation_id" id="consultation_id" class="form-select @error('consultation_id') is-invalid @enderror">
                                    <option value="">-- Aucune --</option>
                                    @foreach($consultations as $consult)
                                        <option value="{{ $consult->id }}" {{ (old('consultation_id') ?? $prescription->consultation_id) == $consult->id ? 'selected' : '' }}>
                                            Consultation #{{ $consult->id }} ({{ \Carbon\Carbon::parse($consult->date)->format('d/m/Y') }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('consultation_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="date_prescription" class="form-label">Date de prescription <span class="text-danger">*</span></label>
                            <input type="date" name="date_prescription" id="date_prescription" class="form-control @error('date_prescription') is-invalid @enderror" value="{{ old('date_prescription') ?? $prescription->date_prescription}}" required>
                            @error('date_prescription')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="instructions" class="form-label">Instructions</label>
                            <textarea name="instructions" id="instructions" class="form-control @error('instructions') is-invalid @enderror" rows="3">{{ old('instructions') ?? $prescription->instructions }}</textarea>
                            @error('instructions')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <h5>Médicaments</h5>
                        <div class="row">
                            @foreach($medicaments as $medicament)
                                @php $pivot = $prescription->medicaments->find($medicament->id)?->pivot; @endphp
                                <div class="col-md-6 mb-3">
                                    <div class="card border p-3 h-100">
                                        <strong>{{ $medicament->nom }}</strong>
                                        <input type="hidden" name="medicaments[{{ $medicament->id }}][id]" value="{{ $medicament->id }}">
                                        <input type="text" name="medicaments[{{ $medicament->id }}][dosage]" class="form-control mt-2" placeholder="Dosage" value="{{ old('medicaments.' . $medicament->id . '.dosage') ?? $pivot->dosage ?? '' }}">
                                        <input type="text" name="medicaments[{{ $medicament->id }}][duree]" class="form-control mt-2" placeholder="Durée" value="{{ old('medicaments.' . $medicament->id . '.duree') ?? $pivot->duree ?? '' }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">← Retour</a>
                            <button type="submit" class="btn btn-success">💾 Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
