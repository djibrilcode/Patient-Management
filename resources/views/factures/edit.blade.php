@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-edit"></i> Modifier Facture #FAC-{{ str_pad($facture->id, 6, '0', STR_PAD_LEFT) }}
            </h4>
            <a href="{{ route('factures.show', $facture->id) }}" class="btn btn-sm btn-info">
                <i class="fas fa-eye"></i> Voir détails
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('factures.update', $facture->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="consultation_id" class="form-label">
                            <i class="fas fa-calendar-check"></i> Consultation
                        </label>
                        <select class="form-select @error('consultation_id') is-invalid @enderror" id="consultation_id" name="consultation_id" required>
                            @foreach($consultations as $consultation)
                                <option value="{{ $consultation->id }}" 
                                    {{ $facture->consultation_id == $consultation->id ? 'selected' : '' }}
                                    {{ old('consultation_id', $facture->consultation_id) == $consultation->id ? 'selected' : '' }}>
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
                               id="montant" name="montant" value="{{ old('montant', $facture->montant) }}" required>
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
                            <option value="impayé" {{ old('statut_paiement', $facture->statut_paiement) == 'impayé' ? 'selected' : '' }}>Impayé</option>
                            <option value="payé" {{ old('statut_paiement', $facture->statut_paiement) == 'payé' ? 'selected' : '' }}>Payé</option>
                            <option value="partiel" {{ old('statut_paiement', $facture->statut_paiement) == 'partiel' ? 'selected' : '' }}>Partiel</option>
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
                            <option value="espèce" {{ old('mode_paiement', $facture->mode_paiement) == 'espèce' ? 'selected' : '' }}>Espèce</option>
                            <option value="carte" {{ old('mode_paiement', $facture->mode_paiement) == 'carte' ? 'selected' : '' }}>Carte</option>
                            <option value="chèque" {{ old('mode_paiement', $facture->mode_paiement) == 'chèque' ? 'selected' : '' }}>Chèque</option>
                            <option value="virement" {{ old('mode_paiement', $facture->mode_paiement) == 'virement' ? 'selected' : '' }}>Virement</option>
                            <option value="mynita" {{ old('mode_paiement', $facture->mode_paiement) == 'mynita' ? 'selected' : '' }}>Mynita</option>
                            <option value="amanata" {{ old('mode_paiement', $facture->mode_paiement) == 'amanata' ? 'selected' : '' }}>Amanata</option>
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
                               id="date_paiement" name="date_paiement" 
                               value="{{ old('date_paiement', $facture->date_paiement ? $facture->date_paiement->format('Y-m-d') : '') }}">
                        @error('date_paiement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('factures.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Annuler
                    </a>
                    <div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Mettre à jour
                        </button>
                        <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash-alt"></i> Supprimer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer définitivement cette facture ?</p>
                <p class="fw-bold">Cette action est irréversible !</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Annuler
                </button>
                <form action="{{ route('factures.destroy', $facture->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i> Confirmer la suppression
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Gestion dynamique des champs obligatoires
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

    // Initialisation au chargement
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('statut_paiement').dispatchEvent(new Event('change'));
    });
</script>
@endsection
@endsection