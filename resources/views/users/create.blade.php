@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-primary">
                <i class="bi bi-person-plus me-2"></i>{{ isset($user) ? 'Modifier' : 'Créer' }} un utilisateur
            </h4>
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card-body">
            <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
                @csrf
                @if(isset($user)) @method('PUT') @endif

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nom complet</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ old('name', $user->name ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{ old('email', $user->email ?? '') }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password"
                               {{ !isset($user) ? 'required' : '' }}>
                        @if(isset($user))
                            <small class="text-muted">Laisser vide pour ne pas modifier</small>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirmation</label>
                        <input type="password" class="form-control" id="password_confirmation" 
                               name="password_confirmation" {{ !isset($user) ? 'required' : '' }}>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="role" class="form-label">Rôle</label>
                        <select class="form-select" id="role" name="role" required>
                            @php
                                $selectedRole = old('role', isset($user) ? $user->role : '');
                            @endphp
                            <option value="admin" {{ $selectedRole == 'admin' ? 'selected' : '' }}>Administrateur</option>
                            <option value="medecin" {{ $selectedRole == 'medecin' ? 'selected' : '' }}>Médecin</option>
                            <option value="secretaire" {{ $selectedRole == 'secretaire' ? 'selected' : '' }}>Secrétaire</option>
                        </select>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ isset($user) ? 'Mettre à jour' : 'Créer' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection