@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($user) ? 'Modifier' : 'Créer' }} un utilisateur</h2>
    
    <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
        @csrf
        @if(isset($user)) @method('PUT') @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nom complet</label>
            <input type="text" class="form-control" id="name" name="name" 
                   value="{{ old('name', $user->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="{{ old('email', $user->email ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password"
                   {{ !isset($user) ? 'required' : '' }}>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmation</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                   {{ !isset($user) ? 'required' : '' }}>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select class="form-select" id="role" name="role" required>
                <option value="admin" {{ (old('role', $user->role ?? '') == 'admin') ? 'selected' : '' }}>Administrateur</option>
                <option value="medecin" {{ (old('role', $user->role ?? '') == 'medecin') ? 'selected' : '' }}>Médecin</option>
                <option value="secretaire" {{ (old('role', $user->role ?? '') == 'secretaire') ? 'selected' : '' }}>Secrétaire</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($user) ? 'Mettre à jour' : 'Créer' }}
        </button>
    </form>
</div>
@endsection