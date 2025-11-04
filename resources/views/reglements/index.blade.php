@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">💰 Gestion des Règlements</h4>
        <a href="{{ route('reglements.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle me-1"></i> Nouveau Règlement
        </a>
    </div>

    <!-- 🔍 Recherche -->
    <form method="GET" class="mb-3">
        <input type="text" name="search" class="form-control w-25 d-inline-block shadow-sm"
               placeholder="🔍 Rechercher par nom du patient..."
               value="{{ request('search') }}">
    </form>

    <div class="table-responsive shadow-sm rounded border">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-uppercase small">
                <tr>
                    <th>#</th>
                    <th>Patient</th>
                    <th>Facture</th>
                    <th>Montant réglé</th>
                    <th>Reste à payer</th>
                    <th>Mode</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reglements as $r)
                <tr>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->facture->consultation->patient->nom ?? '-' }} {{ $r->facture->consultation->patient->prenom ?? '' }}</td>
                    <td>#{{ $r->facture->id }}</td>
                    <td>{{ number_format($r->montant_regle, 0, ',', ' ') }} F</td>
                    <td>{{ number_format($r->facture->montant - $r->facture->reglements->sum('montant_regle'), 0, ',', ' ') }} F</td>
                    <td>{{ ucfirst($r->mode) }}</td>
                    <td>{{ \Carbon\Carbon::parse($r->date_reglement)->format('d/m/Y') }}</td>
                    <td>
                        @php
                            $statut = $r->facture->calculerStatut();
                            $color = $statut === 'payé' ? 'success' : ($statut === 'partiel' ? 'warning' : 'danger');
                        @endphp
                        <span class="badge bg-{{ $color }}">{{ ucfirst($statut) }}</span>
                    </td>
                    <td>
                        <a href="{{ route('reglements.show', $r->id) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('reglements.edit', $r->id) }}" class="btn btn-sm btn-outline-secondary me-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('reglements.destroy', $r->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce règlement ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="text-center text-muted py-4">Aucun règlement trouvé</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $reglements->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">💰 Gestion des Règlements</h4>
        <a href="{{ route('reglements.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle me-1"></i> Nouveau Règlement
        </a>
    </div>

    <!-- 🔍 Recherche -->
    <form method="GET" class="mb-3">
        <input type="text" name="search" class="form-control w-25 d-inline-block shadow-sm"
               placeholder="🔍 Rechercher par nom du patient..."
               value="{{ request('search') }}">
    </form>

    <div class="table-responsive shadow-sm rounded border">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-uppercase small">
                <tr>
                    <th>#</th>
                    <th>Patient</th>
                    <th>Facture</th>
                    <th>Montant réglé</th>
                    <th>Reste à payer</th>
                    <th>Mode</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reglements as $r)
                <tr>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->facture->consultation->patient->nom ?? '-' }} {{ $r->facture->consultation->patient->prenom ?? '' }}</td>
                    <td>#{{ $r->facture->id }}</td>
                    <td>{{ number_format($r->montant_regle, 0, ',', ' ') }} F</td>
                    <td>{{ number_format($r->facture->montant - $r->facture->reglements->sum('montant_regle'), 0, ',', ' ') }} F</td>
                    <td>{{ ucfirst($r->mode) }}</td>
                    <td>{{ \Carbon\Carbon::parse($r->date_reglement)->format('d/m/Y') }}</td>
                    <td>
                        @php
                            $statut = $r->facture->calculerStatut();
                            $color = $statut === 'payé' ? 'success' : ($statut === 'partiel' ? 'warning' : 'danger');
                        @endphp
                        <span class="badge bg-{{ $color }}">{{ ucfirst($statut) }}</span>
                    </td>
                    <td>
                        <a href="{{ route('reglements.show', $r->id) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('reglements.edit', $r->id) }}" class="btn btn-sm btn-outline-secondary me-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('reglements.destroy', $r->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce règlement ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="text-center text-muted py-4">Aucun règlement trouvé</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $reglements->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
