@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Gestion des Factures</h4>
        <a href="{{ route('factures.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle me-1"></i> Nouvelle Facture
        </a>
    </div>

    <!-- 🔍 Filtres -->
    <form class="row g-2 mb-4" method="GET">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control shadow-sm" placeholder="Recherche..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <select name="statut" class="form-select shadow-sm" onchange="this.form.submit()">
                <option value="">Tous statuts</option>
                <option value="payé" {{ request('statut')=='payé'?'selected':'' }}>Payé</option>
                <option value="impayé" {{ request('statut')=='impayé'?'selected':'' }}>Impayé</option>
                <option value="partiel" {{ request('statut')=='partiel'?'selected':'' }}>Partiel</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="mode" class="form-select shadow-sm" onchange="this.form.submit()">
                <option value="">Tous modes</option>
                <option value="espèce" {{ request('mode')=='espèce'?'selected':'' }}>Espèce</option>
                <option value="carte" {{ request('mode')=='carte'?'selected':'' }}>Carte</option>
                <option value="chèque" {{ request('mode')=='chèque'?'selected':'' }}>Chèque</option>
                <option value="virement" {{ request('mode')=='virement'?'selected':'' }}>Virement</option>
                <option value="Mynita" {{ request('mode')== 'Mynita'?'selected':'' }}>Mynita</option>
                <option value="Amanata" {{ request('mode')== 'Amanata'?'selected':'' }}>Amanata</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="date" name="from" class="form-control shadow-sm" value="{{ request('from') }}">
        </div>
        <div class="col-md-2">
            <input type="date" name="to" class="form-control shadow-sm" value="{{ request('to') }}">
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary w-100 shadow-sm">
                <i class="fas fa-filter me-1"></i> Filtrer
            </button>
        </div>
    </form>

    <!-- 📋 Table des factures -->
    <div class="table-responsive rounded shadow-sm border">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-uppercase small">
                <tr>
                    <th>N° Facture</th>
                    <th>Date</th>
                    <th>Patient</th>
                    <th class="text-end">Montant</th>
                    <th>Statut</th>
                    <th>Mode</th>
                    <th>Paiement</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($factures as $facture)
                <tr>
                    <td>FAC-{{ str_pad($facture->id, 6, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $facture->created_at?->format('d/m/Y') ?? '-' }}</td>
                    <td>{{ $facture->consultation->patient->nom ?? '-' }} {{ $facture->consultation->patient->prenom ?? '' }}</td>
                    <td class="text-end fw-bold">{{ number_format($facture->montant, 2) }} FCFA</td>
                    <td>
                        @php
                            $statusClass = match($facture->statut_paiement) {
                                'payé' => 'success',
                                'partiel' => 'warning',
                                default => 'danger',
                            };
                        @endphp
                        <span class="badge bg-{{ $statusClass }} bg-opacity-10 text-{{ $statusClass }} px-3 py-1">
                            {{ ucfirst($facture->statut_paiement) }}
                        </span>
                    </td>
                    <td>{{ $facture->mode_paiement ?? '-' }}</td>
                    <td>
                        @if($facture->date_paiement)
                            {{ \Carbon\Carbon::parse($facture->date_paiement)->format('d/m/Y') }}
                            @if($facture->isLate())
                                <small class="text-danger d-block">Retard {{ $facture->daysLate() }}j</small>
                            @endif
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('factures.show', $facture->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Voir">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('factures.edit', $facture->id) }}" class="btn btn-sm btn-outline-secondary me-1" title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-id="{{ $facture->id }}" title="Supprimer">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-5">Aucune facture trouvée</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- 🔢 Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $factures->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>

<!-- 🗑️ Formulaire de suppression -->
<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            Swal.fire({
                title: 'Supprimer cette facture ?',
                text: "Cette action est irréversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                reverseButtons: true,
                background: '#f8f9fa',
                color: '#212529',
                customClass: {
                    popup: 'rounded-4 shadow-lg',
                    confirmButton: 'btn btn-danger px-4',
                    cancelButton: 'btn btn-secondary px-4 ms-2'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('deleteForm');
                    form.action = `/factures/${id}`;
                    form.submit();
                }
            });
        });
    });
});
</script>
@endsection
