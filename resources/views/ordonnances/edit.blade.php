@extends('layouts.app')

@section('content')
<div class="container">
    <h2><i class="bi bi-pencil-square"></i> Modifier l'Ordonnance</h2>

    <form action="{{ route('ordonnances.update', $ordonnance) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Prescription</label>
            <select name="prescription_id" class="form-select" required>
                @foreach ($prescriptions as $prescription)
                    <option value="{{ $prescription->id }}" {{ $ordonnance->prescription_id == $prescription->id ? 'selected' : '' }}>
                        Prescription #{{ $prescription->id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Numéro</label>
            <input type="text" name="numero" class="form-control" value="{{ $ordonnance->numero }}" required>
        </div>

        <div class="mb-3">
            <label>Date d'émission</label>
            <input type="date" name="date_emission" class="form-control" value="{{ $ordonnance->date_emission }}">
        </div>

        <div class="mb-3">
            <label>Date de validité</label>
            <input type="date" name="date_validite" class="form-control" value="{{ $ordonnance->date_validite }}">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{route('ordonnances.index')}}" class="btn btn-secondary">
             <i class="bi bi-arrow-left"></i> Retour
        </a>
    </form>
</div>
@endsection
