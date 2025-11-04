@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">

    <!-- 🧾 En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">📂 Gestion des Documents Patients</h4>
        <a href="{{ route('documents.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle me-1"></i> Nouveau Document
        </a>
    </div>

    <!-- 🔍 Barre de recherche -->
    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" 
                   placeholder="Recherche par titre ou patient..."
                   value="{{ request('search') }}" oninput="this.form.submit()">
        </div>
      
    </form>

    <!-- 📋 Table -->
    <div class="table-responsive rounded shadow-sm border">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-uppercase small">
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Fichier</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($documents as $doc)
                    <tr>
                        <td>{{ $doc->id }}</td>
                        <td>{{ $doc->patient->nom ?? '-' }} {{ $doc->patient->prenom ?? '' }}</td>
                        <td>{{ $doc->titre }}</td>
                        <td>{{ \Carbon\Carbon::parse($doc->date)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('documents.download', $doc->id) }}" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-download"></i> Télécharger
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('documents.show', $doc->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('documents.edit', $doc->id) }}" class="btn btn-sm btn-outline-secondary me-1" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                             </a>
                                <form action="{{ route('documents.destroy', $doc->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette document ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                          <i class="fas fa-edit"></i>
                                    </button>
                                </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Aucun document trouvé</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- 📄 Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $documents->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- 🗑️ Formulaire de suppression caché -->
<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ✅ Gestion des suppressions avec SweetAlert2
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;

            Swal.fire({
                title: 'Supprimer ce document ?',
                text: "Cette action est irréversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                background: '#f8f9fa',
                color: '#212529',
                buttonsStyling: false,
                customClass: {
                    popup: 'rounded-4 shadow-lg',
                    confirmButton: 'btn btn-danger px-4',
                    cancelButton: 'btn btn-secondary px-4 ms-2'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('deleteForm');
                    form.action = `/documents/${id}`;
                    form.submit();
                }
            });
        });
    });

    // ✅ Notification de succès après suppression
});
</script>
@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'success',
        title: 'Succès',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 1800,
        background: '#f8f9fa',
        color: '#212529',
        customClass: {
            popup: 'rounded-4 shadow-lg'
        }
    });
});
</script>
@endif
@endsection
