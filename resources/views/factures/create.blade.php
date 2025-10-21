@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-plus-circle"></i> Créer une Facture
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('factures.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="consultation_id" class="form-label">
                            <i class="fas fa-calendar-check"></i> Consultation
                        </label>
                        <select class="form-select @error('consultation_id') is-invalid @enderror" id="consultation_id" name="consultation_id" required>
                            <option value="">Sélectionner une consultation</option>
                            @foreach($consultations as $consultation)
                                <option value="{{ $consultation->id }}" {{ old('consultation_id') == $consultation->id ? 'selected' : '' }}>
                                    {{ $consultation->patient->nom }} {{ $consultation->patient->prenom }} - {{ $consultation->date_consultation }}
                                </option>
                            @endforeach
                        </select>
                        @error('consultation_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="montant" class="form-label">
                            <i class="fas fa-euro-sign"></i> Montant (FCFA)
                        </label>
                        <input type="number" step="0.01" class="form-control @error('montant') is-invalid @enderror" 
                               id="montant" name="montant" value="{{ old('montant') }}" required>
                        @error('montant')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="statut_paiement" class="form-label">
                            <i class="fas fa-info-circle"></i> Statut Paiement
                        </label>
                        <select class="form-select @error('statut_paiement') is-invalid @enderror" id="statut_paiement" name="statut_paiement" required>
                            <option value="impayé" {{ old('statut_paiement') == 'impayé' ? 'selected' : '' }}>Impayé</option>
                            <option value="payé" {{ old('statut_paiement') == 'payé' ? 'selected' : '' }}>Payé</option>
                            <option value="partiel" {{ old('statut_paiement') == 'partiel' ? 'selected' : '' }}>Partiel</option>
                        </select>
                        @error('statut_paiement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="mode_paiement" class="form-label">
                            <i class="fas fa-credit-card"></i> Mode Paiement
                        </label>
                        <select class="form-select @error('mode_paiement') is-invalid @enderror" id="mode_paiement" name="mode_paiement">
                            <option value="">-- Sélectionner --</option>
                            <option value="espèce" {{ old('mode_paiement') == 'espèce' ? 'selected' : '' }}>Espèce</option>
                            <option value="carte" {{ old('mode_paiement') == 'carte' ? 'selected' : '' }}>Carte</option>
                            <option value="chèque" {{ old('mode_paiement') == 'chèque' ? 'selected' : '' }}>Chèque</option>
                            <option value="virement" {{ old('mode_paiement') == 'virement' ? 'selected' : '' }}>Virement</option>
                            <option value="mynita" {{ old('mode_paiement') == 'mynita' ? 'selected' : '' }}>Mynita</option>
                            <option value="amanata" {{ old('mode_paiement') == 'amanata' ? 'selected' : '' }}>Amanata</option>
                        </select>
                        @error('mode_paiement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="date_paiement" class="form-label">
                            <i class="fas fa-calendar-day"></i> Date Paiement
                        </label>
                        <input type="date" class="form-control @error('date_paiement') is-invalid @enderror" 
                               id="date_paiement" name="date_paiement" value="{{ old('date_paiement') }}">
                        @error('date_paiement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('factures.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Afficher/masquer les champs en fonction du statut
    document.getElementById('statut_paiement').addEventListener('change', function() {
        const statut = this.value;
        const modePaiement = document.getElementById('mode_paiement');
        const datePaiement = document.getElementById('date_paiement');
        
        if (statut === 'payé' || statut === 'partiel') {
            modePaiement.required = true;
            datePaiement.required = true;
        } else {
            modePaiement.required = false;
            datePaiement.required = false;
        }
    });

    // Déclencher l'événement au chargement
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('statut_paiement').dispatchEvent(new Event('change'));
    });
</script>
@endsection
@endsection