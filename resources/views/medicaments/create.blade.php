@extends('layouts.app')

@section('content')
<div class="container">
    <h2><i class="bi bi-capsule-plus text-primary"></i> Ajouter un Médicament</h2>

    <form method="POST" action="{{ route('medicaments.store') }}">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}" required>
            @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('medicaments.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
