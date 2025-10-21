@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 text-primary fw-bold">
            <i class="bi bi-journal-medical me-2"></i> Liste des Consultations
        </h2>
        <a href="{{ route('consultations.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i> Nouvelle Consultation
        </a>
    </div>

    {{-- Barre de recherche --}}
    <form method="GET" action="{{ route('consultations.index') }}" class="mb-3 w-50">
        <input type="text" name="search" class="form-control" placeholder="Rechercher un patient ou un médecin..." value="{{ request('search') }}" oninput="this.form.submit()">
    </form>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead class="table-light text-uppercase text-secondary small">
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Patient</th>
                            <th scope="col">Médecin</th>
                            <th scope="col">Motif</th>
                            <th scope="col">Traitement</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($consultations as $consultation)
                        <tr>
                            <td class="text-center">{{ $consultation->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($consultation->date_consultation)->format('d/m/Y') }}</td>
                            <td>{{ $consultation->patient->nom ?? 'Non trouvé' }} {{ $consultation->patient->prenom ?? '' }}</td>
                            <td>{{ $consultation->medecin->nom ?? 'Non trouvé' }} {{ $consultation->medecin->prenom ?? '' }}</td>
                            <td>{{ Str::limit($consultation->motif, 40) }}</td>
                            <td>{{ Str::limit($consultation->traitement, 40) }}</td>
                            <td class="text-end">
                                <a href="{{ route('consultations.show', $consultation->id) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('consultations.edit', $consultation->id) }}" class="btn btn-sm btn-outline-success" title="Modifier">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('consultations.destroy', $consultation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette consultation ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4 fst-italic">
                                Aucune consultation trouvée.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($consultations instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="card-footer bg-white d-flex justify-content-center py-3">
            {{ $consultations->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>
@endsection
