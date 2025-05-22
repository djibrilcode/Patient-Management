@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">
        <i class="bi bi-calendar-plus text-primary"></i> Ajouter un Nouveau Rendez-vous
    </h2>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Informations sur le Rendez-vous</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('rendezvous.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="patient_id" class="form-label">Patient</label>
                    <select name="patient_id" id="patient_id" class="form-select @error('patient_id') is-invalid @enderror">
                        <option value="">Sélectionner un patient</option>
                        @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                            {{ $patient->nom }} {{ $patient->prenom }}
                        </option>
                        @endforeach
                    </select>
                    @error('patient_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="medecin_id" class="form-label">Médecin</label>
                    <select name="medecin_id" id="medecin_id" class="form-select @error('medecin_id') is-invalid @enderror">
                        <option value="">Sélectionner un médecin</option>
                        @foreach ($medecins as $medecin)
                        <option value="{{ $medecin->id }}" {{ old('medecin_id') == $medecin->id ? 'selected' : '' }}>
                            {{ $medecin->nom }} {{ $medecin->prenom }}
                        </option>
                        @endforeach
                    </select>
                    @error('medecin_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
                    @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="heure" class="form-label">Heure</label>
                    <input type="time" name="heure" id="heure" class="form-control @error('heure') is-invalid @enderror" value="{{ old('heure') }}">
                    @error('heure')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select name="statut" id="statut" class="form-select @error('statut') is-invalid @enderror">
                        <option value="en attente" {{ old('statut') == 'en attente' ? 'selected' : '' }}>En Attente</option>
                        <option value="confirmé" {{ old('statut') == 'confirmé' ? 'selected' : '' }}>Confirmé</option>
                        <option value="annulé" {{ old('statut') == 'annulé' ? 'selected' : '' }}>Annulé</option>
                    </select>
                    @error('statut')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Ajouter le Rendez-vous</button>
            </form>
        </div>
    </div>
</div>
@endsection
