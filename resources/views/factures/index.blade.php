@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-file-invoice-dollar"></i> Gestion des Factures
            </h4>
            <div>
                <a href="{{ route('factures.create') }}" class="btn btn-success">
                    <i class="fas fa-plus-circle"></i> Nouvelle Facture
                </a>
                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exportModal">
                    <i class="fas fa-file-export"></i> Exporter
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Filtres avancés -->
            <form class="mb-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Recherche..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select name="statut" class="form-select" onchange="this.form.submit()">
                            <option value="">Tous statuts</option>
                            <option value="payé" {{ request('statut') == 'payé' ? 'selected' : '' }}>Payé</option>
                            <option value="impayé" {{ request('statut') == 'impayé' ? 'selected' : '' }}>Impayé</option>
                            <option value="partiel" {{ request('statut') == 'partiel' ? 'selected' : '' }}>Partiel</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="mode" class="form-select" onchange="this.form.submit()">
                            <option value="">Tous modes</option>
                            <option value="espèce" {{ request('mode') == 'espèce' ? 'selected' : '' }}>Espèce</option>
                            <option value="carte" {{ request('mode') == 'carte' ? 'selected' : '' }}>Carte</option>
                            <option value="chèque" {{ request('mode') == 'chèque' ? 'selected' : '' }}>Chèque</option>
                            <option value="virement" {{ request('mode') == 'virement' ? 'selected' : '' }}>Virement</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="from" class="form-control" value="{{ request('from') }}" placeholder="Du...">
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="to" class="form-control" value="{{ request('to') }}" placeholder="Au...">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Statistiques rapides -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Factures
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $stats['total'] }}
                                    </div>
                                </div>
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-invoice text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Montant Total
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format($stats['montant_total'], 2) }} DH
                                    </div>
                                </div>
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-euro-sign text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        En attente
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $stats['impayes'] }}
                                    </div>
                                </div>
                                <div class="icon-circle bg-warning">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Retards >30j
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $stats['retards'] }}
                                    </div>
                                </div>
                                <div class="icon-circle bg-danger">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tableau -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th width="80"><i class="fas fa-hashtag"></i> N° Facture</th>
                            <th><i class="fas fa-calendar-alt"></i> Date</th>
                            <th><i class="fas fa-user-injured"></i> Patient</th>
                            <th><i class="fas fa-money-bill-wave"></i> Montant</th>
                            <th><i class="fas fa-info-circle"></i> Statut</th>
                            <th><i class="fas fa-credit-card"></i> Mode</th>
                            <th><i class="fas fa-calendar-day"></i> Paiement</th>
                            <th width="150"><i class="fas fa-cog"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($factures as $facture)
                        <tr class="{{ $facture->isLate() ? 'table-danger' : '' }}">
                            <td>FAC-{{ str_pad($facture->id_facture, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $facture->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('patients.show', $facture->consultation->patient_id) }}">
                                    {{ $facture->consultation->patient->nom }} {{ $facture->consultation->patient->prenom }}
                                </a>
                            </td>
                            <td class="text-end">{{ number_format($facture->montant, 2) }} DH</td>
                            <td>
                                @if($facture->statut_paiement == 'payé')
                                    <span class="badge bg-success"><i class="fas fa-check-circle"></i> Payé</span>
                                @elseif($facture->statut_paiement == 'partiel')
                                    <span class="badge bg-warning text-dark"><i class="fas fa-exclamation-circle"></i> Partiel</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-times-circle"></i> Impayé</span>
                                @endif
                            </td>
                            <td>
                                @if($facture->mode_paiement)
                                    {{ ucfirst($facture->mode_paiement) }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($facture->date_paiement)
        {{ \Carbon\Carbon::parse($facture->date_paiement)->format('d/m/Y') }}
        @if($facture->isLate())
            <span class="badge bg-danger ms-2">
                <i class="fas fa-clock"></i> +{{ $facture->daysLate() }}j
            </span>
        @endif
    @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('factures.show', $facture->id) }}" 
                                       class="btn btn-sm btn-info" 
                                       title="Voir détails"
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('factures.edit', $facture->id) }}" 
                                       class="btn btn-sm btn-primary"
                                       title="Modifier"
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger delete-btn"
                                            title="Supprimer"
                                            data-bs-toggle="tooltip"
                                            data-id="{{ $facture->id_facture }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="fas fa-info-circle fa-2x mb-3"></i><br>
                                Aucune facture trouvée
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Affichage de <strong>{{ $factures->firstItem() }}</strong> à <strong>{{ $factures->lastItem() }}</strong> 
                    sur <strong>{{ $factures->total() }}</strong> factures
                </div>
                <div>
                    {{ $factures->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Export -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-export me-2"></i>Exporter les factures</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @foreach($factures as $facture)
<a href="{{ route('factures.export', ['facture' => $facture->id]) }}" 
   class="btn btn-sm btn-primary">
    <i class="fas fa-file-pdf"></i> Exporter
</a>
@endforeach
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Format</label>
                        <select name="format" class="form-select">
                            <option value="pdf">PDF</option>
                            <option value="excel">Excel</option>
                            <option value="csv">CSV</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Période</label>
                        <div class="input-group">
                            <input type="date" name="export_from" class="form-control">
                            <span class="input-group-text">à</span>
                            <input type="date" name="export_to" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="export_statut" class="form-select">
                            <option value="">Tous</option>
                            <option value="payé">Payé</option>
                            <option value="impayé">Impayé</option>
                            <option value="partiel">Partiel</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-download"></i> Exporter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Form de suppression caché -->
<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script>
    // Initialisation des tooltips
    document.addEventListener('DOMContentLoaded', function() {
        // Tooltips Bootstrap
        const tooltipList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipList.map(function (el) {
            return new bootstrap.Tooltip(el);
        });

        // Gestion des suppressions
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const factureId = this.getAttribute('data-id');
                
                Swal.fire({
                    title: 'Confirmer la suppression',
                    text: "Êtes-vous sûr de vouloir supprimer cette facture? Cette action est irréversible!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, supprimer!',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('deleteForm');
                        form.action = `/factures/${factureId}`;
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection

@section('styles')
<style>
    .icon-circle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 100%;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .table-hover tbody tr:hover {
        background-color: rgba(25, 135, 84, 0.05);
    }
    .badge {
        font-weight: 500;
        padding: 5px 8px;
    }
</style>
@endsection