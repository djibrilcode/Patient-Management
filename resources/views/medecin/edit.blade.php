@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="mb-0">
                <i class="bi bi-person-plus-fill text-primary"></i> Update un medecin
            </h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('medecin.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Informations du medecin</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('medecin.update',$medecin->id) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- Champ Nom -->
                    <div class="col-md-6">
                        <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror"
                               id="nom" name="nom" value="{{ old('nom',$medecin->nom ) }}" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ Prénom -->
                    <div class="col-md-6">
                        <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('prenom') is-invalid @enderror"
                               id="prenom" name="prenom" value="{{ old('prenom', $medecin->prenom) }} " required>
                        @error('prenom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ specialte -->
                     <div class="col-md-12">
                        <label for="specialité" class="form-label">Spécialité</label>
                        <input type="text" class="form-control @error('specialité') is-invalid @enderror"
                               id="specialité" name="specialité" value="{{ old('specialte', $medecin->spécialité)}}">
                        @error('specialité')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email', $medecin->email)}}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ Téléphone -->
                    <div class="col-md-6">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="tel" class="form-control @error('telephone') is-invalid @enderror"
                               id="telephone" name="telephone" value="{{ old('telephone', $medecin->telephone)}}">
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <!-- Bouton de soumission -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Modefier
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
