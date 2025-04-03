@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- En-tête et bouton d'ajout -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="mb-0">
                <i class="bi bi-people-fill text-primary"></i> Gestion des Patients
            </h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('patients.create') }}" class="btn btn-primary" id="addPatientBtn">
                <i class="bi bi-plus-lg"></i> Nouveau Patient
            </a>
        </div>
    </div>

    <!-- Carte de statistiques -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-primary border-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Patients Totaux</h6>
                            <h3 class="mb-0">{{ $patients->total() }}</h3>
                        </div>
                        <i class="bi bi-people-fill fs-1 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des patients -->
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">Liste des Patients</h5>
                </div>
                <div class="col-md-6">
                    <form method="GET" action="{{ route('patients.index') }}">
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
                <table class="table table-hover" id="patientsTable">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date de Naissance</th>
                            <th>Adresse</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($patients as $patient)
                        <tr data-id="{{ $patient->id }}">
                            <td>{{ $patient->id }}</td>
                            <td>{{ $patient->nom }}</td>
                            <td>{{ $patient->prenom }}</td>
                            <td>{{ $patient->date_naissance}}</td>
                            <td>{{ $patient->adresse }}</td>
                            <td>{{ $patient->email }}</td>
                            <td>{{ $patient->telephone }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('patients.edit', $patient) }}" class="btn btn-sm btn-outline-success edit-btn" title="Modifier">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="delete-form">
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
                            <td colspan="6" class="text-center">Aucun patient trouvé</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {!! $patients->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>


@endsection
