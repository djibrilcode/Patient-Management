@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">🔍 Détail de la Prescription #{{ $prescription->id }}</h4>
            <div>
                <a href="{{ route('prescriptions.index') }}" class="btn btn-light btn-sm">
                    ← Retour à la liste
                </a>
                <a href="{{ route('prescriptions.edit', $prescription) }}" class="btn btn-warning btn-sm">
                    ✏️ Modifier
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6"><strong>Médecin :</strong> {{ $prescription->medecin->nom }} {{ $prescription->medecin->prenom }}</div>
                <div class="col-md-6"><strong>Patient :</strong> {{ $prescription->patient->nom }} {{ $prescription->patient->prenom }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Consultation :</strong>
                    @if ($prescription->consultation)
                        #{{ $prescription->consultation->id }} ({{ \Carbon\Carbon::parse($prescription->consultation->date)->format('d/m/Y') }})
                    @else
                        Aucune
                    @endif
                </div>
                <div class="col-md-6">
                    <strong>Date de prescription :</strong> {{ \Carbon\Carbon::parse($prescription->date_prescription)->format('d/m/Y') }}
                </div>
            </div>

            <div class="mb-3">
                <strong>Instructions :</strong>
                <p class="border p-2 rounded bg-light">{{ $prescription->instructions ?? '-' }}</p>
            </div>

            <h5 class="mt-4">💊 Médicaments associés</h5>
            @if($prescription->medicaments->isEmpty())
                <p class="text-muted">Aucun médicament associé.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mt-2">
                        <thead class="table-primary">
                            <tr>
                                <th>Nom du médicament</th>
                                <th>Dosage</th>
                                <th>Durée</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prescription->medicaments as $medicament)
                                <tr>
                                    <td>{{ $medicament->nom }}</td>
                                    <td>{{ $medicament->pivot->dosage ?? '-' }}</td>
                                    <td>{{ $medicament->pivot->duree ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
