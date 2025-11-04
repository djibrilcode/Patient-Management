@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-4">✏️ Modifier le règlement</h4>

    <form action="{{ route('reglements.update', $reglement->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Facture associée (non modifiable) -->
        <div class="mb-3">
            <label class="form-label">Facture</label>
            <input type="text" class="form-control" 
                   value="Facture #{{ $reglement->facture->id }} - {{ $reglement->facture->consultation->patient->nom ?? '' }}" readonly>
        </div>

        <!-- Infos facture -->
        @php
            $facture = $reglement->facture;
            $total = $facture->montant;
            $deja = $facture->reglements()->where('id', '!=', $reglement->id)->sum('montant_regle');
            $reste = $total - $deja;
        @endphp

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Montant total</label>
                <input type="text" class="form-control" value="{{ number_format($total, 0, ',', ' ') }} F" readonly>
            </div>
            <div class="col-md-4">
                <label class="form-label">Déjà réglé (autres paiements)</label>
                <input type="text" class="form-control" value="{{ number_format($deja, 0, ',', ' ') }} F" readonly>
            </div>
            <div class="col-md-4">
                <label class="form-label">Reste à payer</label>
                <input type="text" id="reste_a_payer" class="form-control text-danger fw-bold" 
                       value="{{ number_format($reste, 0, ',', ' ') }} F" readonly>
            </div>
        </div>

        <!-- Montant réglé -->
        <div class="mb-3">
            <label for="montant_regle" class="form-label">Montant réglé</label>
            <input type="number" step="0.01" name="montant_regle" id="montant_regle" 
                   value="{{ $reglement->montant_regle }}" class="form-control" required>
        </div>

        <!-- Mode de paiement -->
        <div class="mb-3">
            <label for="mode" class="form-label">Mode de paiement</label>
            <select name="mode" id="mode" class="form-select" required>
                @foreach(['espèce','carte','chèque','virement','mynita','amanata'] as $mode)
                    <option value="{{ $mode }}" @selected($reglement->mode === $mode)>{{ ucfirst($mode) }}</option>
                @endforeach
            </select>
        </div>

        <!-- Date -->
        <div class="mb-3">
            <label for="date_reglement" class="form-label">Date du règlement</label>
            <input type="date" name="date_reglement" value="{{ $reglement->date_reglement }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">💾 Mettre à jour</button>
        <a href="{{ route('reglements.index') }}" class="btn btn-secondary">⬅️ Retour</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('montant_regle');
    const reste = parseFloat("{{ $reste }}");

    input.addEventListener('input', function() {
        const val = parseFloat(this.value || 0);
        if (val > reste) {
            Swal.fire({
                icon: 'warning',
                title: 'Montant trop élevé 💰',
                text: `Le montant saisi dépasse le reste dû (${reste.toLocaleString()} F).`,
                confirmButtonText: 'Corriger',
                confirmButtonColor: '#3085d6',
            });
            this.value = reste;
        }
    });
});
</script>
@endsection
