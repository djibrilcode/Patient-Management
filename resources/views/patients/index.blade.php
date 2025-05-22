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
        <div class="col-md-6 text-md-end">
            <a href="{{ route('patients.create') }}" class="btn btn-primary" id="addPatientBtn">
                <i class="bi bi-plus-lg"></i> Nouveau Patient
            </a>
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
                    <!-- Formulaire de recherche -->
                    <form method="GET" action="{{ route('patients.index') }}" class="d-flex">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher par nom, prénom, téléphone..." 
                               value="{{ request('search') }}" oninput="this.form.submit()">
                        <button class="btn btn-outline-primary ms-2" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="patientsTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
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
                            <tr>
                                <td>{{ $patient->id }}</td>
                                <td>{{ $patient->nom }}</td>
                                <td>{{ $patient->prenom }}</td>
                                <td>{{ $patient->date_naissance }}</td>
                                <td>{{ $patient->adresse }}</td>
                                <td>{{ $patient->email }}</td>
                                <td>{{ $patient->telephone }}</td>
                                <td>
<div class="d-flex gap-2 align-items-center">
    <!-- Bouton Voir -->
    <a href="{{ route('patients.show', $patient->id) }}" 
       class="btn btn-sm btn-outline-primary rounded-circle p-2"
       title="Voir détails"
       data-bs-toggle="tooltip"
       data-bs-placement="top">
        <i class="bi bi-eye-fill fs-6"></i>
    </a>

    <!-- Bouton Modifier -->
    <a href="{{ route('patients.edit', $patient) }}" 
       class="btn btn-sm btn-outline-success rounded-circle p-2"
       title="Modifier"
       data-bs-toggle="tooltip"
       data-bs-placement="top">
        <i class="bi bi-pencil-fill fs-6"></i>
    </a>

    <!-- Bouton Supprimer -->
    <form id="delete-form-{{ $patient->id }}" 
          action="{{ route('patients.destroy', $patient->id) }}" 
          method="POST" 
          class="d-inline">
        @csrf
        @method('DELETE')
        <button type="button" 
                onclick="confirmDelete('delete-form-{{ $patient->id }}', '{{ addslashes($patient->nom) }} {{ addslashes($patient->prenom) }}')" 
                class="btn btn-sm btn-outline-danger rounded-circle p-2"
                title="Supprimer"
                data-bs-toggle="tooltip"
                data-bs-placement="top">
            <i class="bi bi-trash-fill fs-6"></i>
        </button>
    </form>
</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Aucun patient trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {!! $patients->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>
@endsection
