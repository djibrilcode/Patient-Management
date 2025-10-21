@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2><i class="bi bi-pencil-square text-primary"></i> Modifier le Médecin</h2>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('medecins.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5>Informations du Médecin</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('medecins.update', $medecin->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                    <input type="text" id="nom" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $medecin->nom) }}" required>
                    @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                    <input type="text" id="prenom" name="prenom" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom', $medecin->prenom) }}" required>
                    @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="specialite_id" class="form-label">Spécialité</label>
                    <select id="specialite_id" name="specialite_id" class="form-select @error('specialite_id') is-invalid @enderror">
                        <option value="">-- Sélectionner une spécialité --</option>
                        @foreach($specialites as $specialite)
                            <option value="{{ $specialite->id }}" {{ (old('specialite_id', $medecin->specialite_id) == $specialite->id) ? 'selected' : '' }}>
                                {{ $specialite->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('specialite_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $medecin->email) }}">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone', $medecin->telephone) }}">
                    @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Mettre à jour
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
