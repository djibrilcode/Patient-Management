@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- En-tête et bouton d'ajout -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="mb-0">
                <i class="bi bi-people-fill text-primary"></i> Gestion des Medecins
            </h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('medecin.create') }}" class="btn btn-primary" id="addmedecinBtn">
                <i class="bi bi-plus-lg"></i> Nouveau medecin
            </a>
        </div>
    </div>

    {{-- <!-- Carte de statistiques -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-primary border-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">medecins Totaux</h6>
                            <h3 class="mb-0">{{ $medecins->total() }}</h3>
                        </div>
                        <i class="bi bi-people-fill fs-1 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Tableau des medecins -->
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">Liste des medecins</h5>
                </div>
                <div class="col-md-6">
                    <form method="GET" action="{{ route('medecin.index') }}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
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
                            <th>spécialité</th>
                            <th>telphonne</th>
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
                            <td>{{ $medecin->spécialité}}</td>
                            <td>{{ $medecin->telephone }}</td>
                            <td>{{ $medecin->email }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('medecin.edit', $medecin->id) }}" class="btn btn-sm btn-outline-success edit-btn" title="Modifier">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="{{ route('medecin.destroy', $medecin->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Aucun medecin trouvé</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {!! $medecins->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>


@endsection
