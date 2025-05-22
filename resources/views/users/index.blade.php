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
                        <input type="text" name="search" class="form-control" placeholder="Rechercher..." 
                               value="{{ request('search') }}">
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

            <!-- Tableau des utilisateurs -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <a href="{{ route('users.index', [
                                    'sort_field' => 'name',
                                    'sort_direction' => request('sort_field') == 'name' && request('sort_direction') == 'asc' ? 'desc' : 'asc',
                                    'search' => request('search'),
                                    'role' => request('role')
                                ]) }}">
                                    Nom
                                    @if(request('sort_field') == 'name')
                                        <i class="bi bi-chevron-{{ request('sort_direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Email</th>
                            <th>
                                <a href="{{ route('users.index', [
                                    'sort_field' => 'role',
                                    'sort_direction' => request('sort_field') == 'role' && request('sort_direction') == 'asc' ? 'desc' : 'asc',
                                    'search' => request('search'),
                                    'role' => request('role')
                                ]) }}">
                                    Rôle
                                    @if(request('sort_field') == 'role')
                                        <i class="bi bi-chevron-{{ request('sort_direction') == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Créé le</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge 
                                        @if($user->role == 'admin') bg-danger
                                        @elseif($user->role == 'medecin') bg-primary
                                        @else bg-secondary
                                        @endif">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-success" title="Modifier">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')"
                                                    title="Supprimer">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">Aucun utilisateur trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection