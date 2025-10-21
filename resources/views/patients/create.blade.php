@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="mb-0">
                <i class="bi bi-person-plus-fill text-primary"></i> Ajouter un nouveau patient
            </h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Informations du patient</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('patients.store') }}">
                @csrf
                
                <div class="row g-3">
                    <!-- Champ Nom -->
                    <div class="col-md-6">
                        <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                               id="nom" name="nom" value="{{ old('nom') }}" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Champ Prénom -->
                    <div class="col-md-6">
                        <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                               id="prenom" name="prenom" value="{{ old('prenom') }}" required placeholder="Prenom">
                        @error('prenom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ adresse -->
                     <div class="col-md-12">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control @error('adresse') is-invalid @enderror" 
                               id="adresse" name="adresse" value="{{ old('adresse') }}">
                        @error('adresse')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Champ Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Champ Téléphone -->
                    <div class="col-md-6">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="tel" class="form-control @error('telephone') is-invalid @enderror" 
                               id="telephone" name="telephone" value="{{ old('telephone') }}">
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Champ Date de Naissance -->
                    <div class="col-md-6">
                        <label for="date_naissance" class="form-label">Date de naissance</label>
                        <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" 
                               id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}">
                        @error('date_naissance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Bouton de soumission -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection