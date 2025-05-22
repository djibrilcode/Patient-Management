@extends('layouts.app')

@section('content')

@if(session('success'))
    <script>
        showSuccessAlert("{{ session('success') }}");
    </script>
@endif

@if(session('error'))
    <script>
        showErrorAlert("{{ session('error') }}");
    </script>
@endif
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Liste des consultations</h2>
        <a href="{{ route('consultations.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Nouvelle Consultation
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>consultation</th>
                            <th>Médecin</th>
                            <th>Motif</th>
                            <th>Traitement</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($consultations as $consultation)
                            <tr>
                                <td>{{ $consultation->id }}</td>
                                <td>{{ $consultation->date_consultation }}</td>
                                <td>{{ $consultation->consultation->nom ?? 'Non trouvé' }}</td>
                                <td>{{ $consultation->medecin->nom ?? 'Non trouvé' }}</td>
                                <td>{{ Str::limit($consultation->motif, 30) }}</td>
                                <td>{{ Str::limit($consultation->traitement, 30) }}</td>
                                <td class="text-end">
                                        
                                <a href="{{ route('consultations.show', $consultation->id) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                                        <i class="bi bi-eye-fill"></i>
                               </a>
                                    <a href="{{ route('consultations.edit', $consultation) }}" class="btn btn-sm btn-outline-success" title="Modifier">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                   <form id="delete-form-{{ $consultation->id }}" action="{{ route('consultations.destroy', $consultation->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="button" onclick="confirmDelete('delete-form-{{ $consultation->id }}')" class="btn btn-danger btn-sm">
        <i class="bi bi-trash"></i> Supprimer
    </button>
</form>
                                    
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center p-4">Aucune consultation trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4"">
            {{ $consultations->links('pagination::bootstrap-4') }}
        </div>
    </div>

</div>
@endsection
