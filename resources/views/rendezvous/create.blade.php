@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Prendre un Rendez-vous</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rendezvous.store') }}" method="POST">
        @csrf

        {{-- Patient --}}
        <div class="form-group mb-3">
            <label for="patient_id">Patient</label>
            <select name="patient_id" class="form-control" required>
                <option value="">-- Sélectionner un patient --</option>
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->prenom }} {{ $patient->nom }}</option>
                @endforeach
            </select>
        </div>

        {{-- Médecin + spécialité --}}
        <div class="form-group mb-3">
            <label for="medecin_id">Médecin</label>
            <select name="medecin_id" class="form-control" required>
                <option value="">-- Sélectionner un médecin --</option>
                @foreach ($medecins as $medecin)
                    <option value="{{ $medecin->id }}">
                        Dr. {{ $medecin->prenom }} {{ $medecin->nom }} — {{ $medecin->specialite->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Date --}}
        <div class="form-group mb-3">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        {{-- Heure --}}
        <div class="form-group mb-3">
            <label for="heure">Heure</label>
            <input type="time" name="heure" class="form-control" required >
        </div>

        {{-- Statut --}}
        <div class="form-group mb-3">
            <label for="statut">Statut</label>
            <select name="statut" class="form-control" required>
                <option value="prévu">Prévu</option>
                <option value="confirmé">Confirmé</option>
                <option value="en attente">En attente</option>
                <option value="annulé">Annulé</option>
                <option value="terminé">Terminé</option>
            </select>
        </div>

        {{-- Motif --}}
        <div class="form-group mb-3">
            <label for="motif">Motif</label>
            <textarea name="motif" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection
