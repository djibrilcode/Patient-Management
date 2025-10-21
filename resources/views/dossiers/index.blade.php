@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="bi bi-folder2-open me-2"></i> Dossiers Médicaux</h2>
        <a href="{{ route('dossiers.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-folder-plus me-1"></i> Nouveau Dossier
        </a>
    </div>

    {{-- Barre de recherche --}}
    <form action="{{ route('dossiers.index') }}" method="GET" class="mb-4">
        <div class="input-group shadow-sm">
            <input type="text" name="search" class="form-control" placeholder="🔍 Rechercher un patient..." value="{{ request('search') }}">
            <button class="btn btn-primary"><i class="bi bi-search"></i> Rechercher</button>
        </div>
    </form>

    {{-- Liste des dossiers --}}
    <div class="row">
        @forelse($dossiers as $dossier)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-person-circle me-1"></i>
                            {{ $dossier->patient->nom ?? 'Nom inconnu' }} {{ $dossier->patient->prenom ?? '' }}
                        </h5>
                        <p class="mb-2"><i class="bi bi-briefcase-medical me-1"></i> Médecin : 
                            <span class="badge bg-secondary">{{ $dossier->medecin?->nom ?? 'Non assigné' }}</span>
                        </p>

                        <ul class="list-unstyled mt-2 mb-0 small">
                            <li><strong>🩸 Allergies :</strong> {{ $dossier->allergies ?: 'Aucune' }}</li>
                            <li><strong>📜 Antécédents perso :</strong> {{ $dossier->antecedents_personnels ?: '—' }}</li>
                            <li><strong>👨‍👩‍👧 Famille :</strong> {{ $dossier->antecedents_familiaux ?: '—' }}</li>
                            <li><strong>💊 Traitements :</strong> {{ $dossier->traitements_chroniques ?: '—' }}</li>
                            <li><strong>🚬 Habitudes :</strong> {{ $dossier->habitudes ?: '—' }}</li>
                            <li><strong>📝 Remarques :</strong> {{ $dossier->remarques ?: '—' }}</li>
                        </ul>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between">
                        <a href="{{ route('dossiers.show', $dossier) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye me-1"></i> Voir</a>
                        <a href="{{ route('dossiers.edit', $dossier) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil-square me-1"></i> Modifier</a>
                        <form action="{{ route('dossiers.destroy', $dossier) }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete"><i class="bi bi-trash me-1"></i> Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info shadow-sm">Aucun dossier trouvé.</div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $dossiers->links() }}
    </div>
</div>

{{-- SweetAlert2 pour suppression --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            Swal.fire({
                title: 'Confirmer la suppression ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });
});
</script>
@endsection
