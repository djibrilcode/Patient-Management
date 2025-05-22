@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier la Consultation</h1>

    <form action="{{ route('consultations.update', $consultation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="patient_id" class="form-label">Patient</label>
            <select name="patient_id" id="patient_id" class="form-control">
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" @if($patient->id == $consultation->patient_id) selected @endif>
                        {{ $patient->nom }} {{ $patient->prenom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="medecin_id" class="form-label">Médecin</label>
            <select name="medecin_id" id="medecin_id" class="form-control">
                @foreach($medecins as $medecin)
                    <option value="{{ $medecin->id }}" @if($medecin->id == $consultation->medecin_id) selected @endif>
                        {{ $medecin->nom }} {{ $medecin->prenom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date_consultation" class="form-label">Date de Consultation</label>
            <input type="date" name="date_consultation" id="date_consultation" class="form-control" value="{{ $consultation->date_consultation }}">
        </div>

        <div class="mb-3">
            <label for="motif" class="form-label">Motif</label>
            <input type="text" name="motif" id="motif" class="form-control" value="{{ $consultation->motif }}">
        </div>

        <div class="mb-3">
                    <label for="traitement" class="form-label">Traitement</label>
                    <textarea name="traitement" id="traitement" class="form-control" rows="5">{{ old('traitement', $consultation->traitement ?? '') }}</textarea>
          </div>


        <button type="submit" class="btn btn-success">Mettre à jour</button>
    </form>
</div>
@endsection
