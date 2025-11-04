@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-4">🧾 Nouveau Règlement</h4>

    <form action="{{ route('reglements.store') }}" method="POST">
        @csrf

        <!-- Choix de la facture -->
        <div class="mb-3">
            <label for="facture_id" class="form-label">Facture</label>
            <select name="facture_id" id="facture_id" class="form-select" required>
                <option value="">-- Sélectionner une facture --</option>
                @foreach($factures as $f)
                    <option value="{{ $f->id }}" 
                        data-montant="{{ $f->montant }}"
                        data-regle="{{ $f->reglements_sum_montant_regle }}"
                        data-restant="{{ $f->restant }}">
                        #{{ $f->id }} - {{ $f->consultation->patient->nom ?? 'Inconnu' }} {{ $f->consultation->patient->prenom ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Infos facture auto-remplies -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Montant total</label>
                <input type="text" id="montant_total" class="form-control" readonly>
            </div>
            <div class="col-md-4">
                <label class="form-label">Déjà réglé</label>
                <input type="text" id="montant_regle" class="form-control" readonly>
            </div>
            <div class="col-md-4">
                <label class="form-label">Reste à payer</label>
                <input type="text" id="reste_a_payer" class="form-control text-danger fw-bold" readonly>
            </div>
        </div>

        <!-- Montant du règlement -->
        <div class="mb-3">
            <label for="montant_regle_input" class="form-label">Montant réglé</label>
            <input type="number" step="0.01" name="montant_regle" id="montant_regle_input" class="form-control" required>
        </div>

        <!-- Mode de paiement -->
        <div class="mb-3">
            <label for="mode" class="form-label">Mode de paiement</label>
            <select name="mode" id="mode" class="form-select" required>
                <option value="">-- Sélectionner --</option>
                <option value="espèce">Espèce</option>
                <option value="carte">Carte</option>
                <option value="chèque">Chèque</option>
                <option value="virement">Virement</option>
                <option value="mynita">Mynita</option>
                <option value="amanata">Amanata</option>
            </select>
        </div>

        <!-- Date -->
        <div class="mb-3">
            <label for="date_reglement" class="form-label">Date du règlement</label>
            <input type="date" name="date_reglement" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">
            💾 Enregistrer
        </button>
        <a href="{{ route('reglements.index') }}" class="btn btn-secondary">⬅️ Retour</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const selectFacture = document.getElementById('facture_id');
    const montantTotal = document.getElementById('montant_total');
    const montantRegle = document.getElementById('montant_regle');
    const reste = document.getElementById('reste_a_payer');

    selectFacture.addEventListener('change', function() {
        const opt = this.options[this.selectedIndex];
        montantTotal.value = parseFloat(opt.dataset.montant || 0).toLocaleString() + " F";
        montantRegle.value = parseFloat(opt.dataset.regle || 0).toLocaleString() + " F";
        reste.value = parseFloat(opt.dataset.restant || 0).toLocaleString() + " F";
    });
});
</script>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const selectFacture = document.getElementById('facture_id');
    const montantTotal = document.getElementById('montant_total');
    const montantRegle = document.getElementById('montant_regle');
    const reste = document.getElementById('reste_a_payer');
    const montantInput = document.getElementById('montant_regle_input');

    let resteNumerique = 0;

    selectFacture.addEventListener('change', function() {
        const opt = this.options[this.selectedIndex];
        const total = parseFloat(opt.dataset.montant || 0);
        const deja = parseFloat(opt.dataset.regle || 0);
        resteNumerique = parseFloat(opt.dataset.restant || 0);

        montantTotal.value = total.toLocaleString() + " F";
        montantRegle.value = deja.toLocaleString() + " F";
        reste.value = resteNumerique.toLocaleString() + " F";
    });

    montantInput.addEventListener('input', function() {
        const saisi = parseFloat(this.value || 0);
        if (saisi > resteNumerique && resteNumerique > 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Montant trop élevé 💸',
                text: `Le montant saisi dépasse le reste dû (${resteNumerique.toLocaleString()} F).`,
                confirmButtonText: 'Corriger',
                confirmButtonColor: '#3085d6',
            });
            this.value = resteNumerique;
        }
    });
});
</script>
