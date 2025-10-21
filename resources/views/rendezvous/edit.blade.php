@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier un Rendez-vous</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rendezvous.update', $rendezvous->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Patient --}}
        <div class="form-group mb-3">
            <label for="patient_id">Patient</label>
            <select name="patient_id" class="form-control" required>
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}" {{ $rendezvous->patient_id == $patient->id ? 'selected' : '' }}>
                        {{ $patient->prenom }} {{ $patient->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Médecin --}}
        <div class="form-group mb-3">
            <label for="medecin_id">Médecin</label>
            <select name="medecin_id" class="form-control" required>
                @foreach ($medecins as $medecin)
                    <option value="{{ $medecin->id }}" {{ $rendezvous->medecin_id == $medecin->id ? 'selected' : '' }}>
                        Dr. {{ $medecin->prenom }} {{ $medecin->nom }} — {{ $medecin->specialite->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Date --}}
        <div class="form-group mb-3">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" value="{{ $rendezvous->date }}" required>
        </div>

        {{-- Heure --}}
        <div class="form-group mb-3">
            <label for="heure">Heure</label>
            <input type="time" name="heure" class="form-control" value="{{ $rendezvous->heure }}" required>
        </div>

        {{-- Statut --}}
        <div class="form-group mb-3">
            <label for="statut">Statut</label>
            <select name="statut" class="form-control" required>
                @foreach (['prévu', 'confirmé', 'en attente', 'annulé', 'terminé'] as $statut)
                    <option value="{{ $statut }}" {{ $rendezvous->statut === $statut ? 'selected' : '' }}>
                        {{ ucfirst($statut) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Motif --}}
        <div class="form-group mb-3">
            <label for="motif">Motif</label>
            <textarea name="motif" class="form-control">{{ $rendezvous->motif }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
