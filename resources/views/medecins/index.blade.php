@extends('layouts.app')

@section('content')
<div class="container-fluid">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- En-tête et bouton d'ajout -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="mb-0">
                <i class="bi bi-people-fill text-primary"></i> Gestion des Médecins
            </h2>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('medecins.create') }}" class="btn btn-primary" id="addmedecinBtn">
                <i class="bi bi-plus-lg"></i> Nouveau Médecin
            </a>
        </div>
    </div>

    <!-- Carte de statistiques (optionnel) -->
    {{-- <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Médecins Totaux</h6>
                            <h3 class="mb-0">{{ $medecins->total() }}</h3>
                        </div>
                        <i class="bi bi-people-fill fs-1 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Tableau des médecins -->
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">Liste des Médecins</h5>
                </div>
                <div class="col-md-6">
                    <form method="GET" action="{{ route('medecins.index') }}" class="d-flex">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher par nom, prénom, téléphone" value="{{ request('search') }}" oninput="this.form.submit()">
                        <button class="btn btn-outline-primary ms-2" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="medecinsTable">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Spécialité</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($medecins as $medecin)
                            <tr data-id="{{ $medecin->id }}">
                                <td>{{ $medecin->id }}</td>
                                <td>{{ $medecin->nom }}</td>
                                <td>{{ $medecin->prenom }}</td>
                                <td>{{ $medecin->spécialité }}</td>
                                <td>{{ $medecin->telephone }}</td>
                                <td>{{ $medecin->email }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('medecins.edit', $medecin->id) }}" class="btn btn-sm btn-outline-success" title="Modifier">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form id="delete-form-{{ $medecin->id }}" action="{{ route('medecins.destroy', $medecin->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="button" onclick="confirmDelete('delete-form-{{ $medecin->id }}')" class="btn btn-danger btn-sm">
        <i class="bi bi-trash"></i> Supprimer
    </button>
</form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucun médecin trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {!! $medecins->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>
@endsection
