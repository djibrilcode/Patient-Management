@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">
        <i class="bi bi-pencil-square text-success"></i> Modifier la Spécialité
    </h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('specialites.update', $specialite->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de la spécialité</label>
                    <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $specialite->nom) }}" required>
                    @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-success">Mettre à jour</button>
                <a href="{{ route('specialites.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
