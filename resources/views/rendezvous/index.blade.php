@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="mb-0">
                <i class="bi bi-calendar-check-fill text-primary"></i> Gestion des Rendez-vous
            </h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('rendezvous.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Nouveau Rendez-vous
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">Liste des Rendez-vous</h5>
                </div>
                <div class="col-md-6">
                    <form method="GET" action="{{ route('rendezvous.index') }}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Rechercher par patient ou médecin"
                                   value="{{ request('search') }}" oninput="this.form.submit()">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Médecin</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rendezvous as $rdv)
                        <tr>
                            <td>{{ $rdv->id }}</td>
                            <td>{{ $rdv->patient->nom }} {{ $rdv->patient->prenom }}</td>
                            <td>{{ $rdv->medecin->nom }} {{ $rdv->medecin->prenom }}</td>
                            <td>{{ \Carbon\Carbon::parse($rdv->date)}}</td>
                            <td>{{ $rdv->heure }}</td>
                            <td>{{ ucfirst($rdv->statut) }}</td>
                            <td>
    <div class="d-flex gap-2">
        <a href="{{ route('rendezvous.show', $rdv->id) }}" class="btn btn-sm btn-outline-primary" title="Voir">
            <i class="bi bi-eye-fill"></i>
        </a>
        <a href="{{ route('rendezvous.edit', $rdv->id) }}" class="btn btn-sm btn-outline-success" title="Modifier">
            <i class="bi bi-pencil-fill"></i>
        </a>
       <form id="delete-form-{{ $rdv->id }}" action="{{ route('rendezvous.destroy', $rdv->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="button" onclick="confirmDelete('delete-form-{{ $rdv->id }}')" class="btn btn-danger btn-sm">
        <i class="bi bi-trash"></i> Supprimer
    </button>
</form>
    </div>
</td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Aucun rendez-vous trouvé</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {!! $rendezvous->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>
@endsection
