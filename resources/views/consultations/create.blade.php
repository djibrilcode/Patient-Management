@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nouvelle Consultation</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


    <form action="{{ route('consultations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="patient_id" class="form-label">Patient</label>
            <select name="patient_id" id="patient_id" class="form-control">
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->nom }} {{ $patient->prenom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="medecin_id" class="form-label">Médecin</label>
            <select name="medecin_id" id="medecin_id" class="form-control">
                @foreach($medecins as $medecin)
                    <option value="{{ $medecin->id }}">{{ $medecin->nom }} {{ $medecin->prenom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
                    <label for="date_consultation" class="form-label">Date de Consultation</label>
                    <input type="date" name="date_consultation" id="date_consultation" class="form-control" value="{{ old('date_consultation') }}">
          </div>


        <div class="mb-3">
            <label for="motif" class="form-label">Motif</label>
            <input type="text" name="motif" id="motif" class="form-control">
        </div>

        <div class="mb-3">
                    <label for="traitement" class="form-label">Traitement</label>
                     <textarea name="traitement" id="traitement" class="form-control" rows="5">{{ old('traitement', $consultation->traitement ?? '') }}</textarea>
          </div>


        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</div>
@endsection
