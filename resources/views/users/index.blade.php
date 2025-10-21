@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-people me-2"></i>Gestion des Utilisateurs
            </h4>
            <a href="{{ route('users.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Nouveau
            </a>
        </div>

        <div class="card-body">
            <!-- Formulaire de recherche -->
            <form action="{{ route('users.index') }}" method="GET" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="role" class="form-select">
                            <option value="">Tous les rôles</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                            <option value="medecin" {{ request('role') == 'medecin' ? 'selected' : '' }}>Médecin</option>
                            <option value="secretaire" {{ request('role') == 'secretaire' ? 'selected' : '' }}>Secrétaire</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Filtrer
                        </button>
                    </div>
                </div>
            </form>

            <!-- Composant tableau -->
            <x-index-users-table 
                :data="$users"
                :searchAction="route('users.index')"
                :sortField="request('sort_field')"
                :sortDirection="request('sort_direction', 'asc')"
            />
        </div>
    </div>
</div>
@endsection
