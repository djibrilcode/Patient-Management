@extends('layouts.app')

@section('content')
<div class="container">
    <h2><i class="bi bi-pencil-square text-success"></i> Modifier le Médicament</h2>

    <form method="POST" action="{{ route('medicaments.update', $medicament) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                   value="{{ old('nom', $medicament->nom) }}" required>
            @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" rows="3" class="form-control">{{ old('description', $medicament->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <a href="{{ route('medicaments.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
