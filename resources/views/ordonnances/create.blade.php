@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-file-earmark-plus"></i> Nouvelle Ordonnance
            </h4>
            <a href="{{ route('ordonnances.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
        </div>

        <div class="card-body">
            {{-- Message de succès ou d'erreur --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Oups !</strong> Des erreurs sont survenues :<br>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulaire de création --}}
            <form action="{{ route('ordonnances.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="prescription_id" class="form-label fw-semibold">Prescription</label>
                    <select name="prescription_id" id="prescription_id" class="form-select" required>
                        <option value="">-- Sélectionnez une prescription --</option>
                        @foreach ($prescriptions as $prescription)
                            <option value="{{ $prescription->id }}">
                                Prescription #{{ $prescription->id }} – {{ $prescription->date_prescription }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="numero" class="form-label fw-semibold">Numéro</label>
                    <input type="text" name="numero" id="numero" class="form-control"
                           value="{{ old('numero') }}" placeholder="Ex: ORD-001" required>
                </div>

                <div class="mb-3">
                    <label for="date_emission" class="form-label fw-semibold">Date d’émission</label>
                    <input type="date" name="date_emission" id="date_emission" class="form-control"
                           value="{{ old('date_emission') }}" required>
                </div>

                <div class="mb-3">
                    <label for="date_validite" class="form-label fw-semibold">Date de validité</label>
                    <input type="date" name="date_validite" id="date_validite" class="form-control"
                           value="{{ old('date_validite') }}">
                </div>

                <div class="d-flex justify-content-between">
                      <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Valider
                    </button>
                    <a href="{{ route('ordonnances.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                  
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
