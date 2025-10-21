@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Détails du Rendez-vous</h2>

    <div class="card shadow mt-4">
        <div class="card-body">
            <h5 class="card-title">Patient</h5>
            <p><strong>Nom :</strong> {{ $rendezvous->patient->prenom }} {{ $rendezvous->patient->nom }}</p>
            <p><strong>Téléphone :</strong> {{ $rendezvous->patient->telephone }}</p>

            <hr>

            <h5 class="card-title">Médecin</h5>
            <p><strong>Nom :</strong> Dr. {{ $rendezvous->medecin->prenom }} {{ $rendezvous->medecin->nom }}</p>
            <p><strong>Spécialité :</strong> {{ $rendezvous->medecin->specialite->nom }}</p>

            <hr>

            <h5 class="card-title">Informations du rendez-vous</h5>
            <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($rendezvous->date)->format('d/m/Y') }}</p>
            <p><strong>Heure :</strong> {{ \Carbon\Carbon::parse($rendezvous->heure)->format('H:i') }}</p>
            <p><strong>Statut :</strong> 
                @php
                    $colors = [
                        'confirmé' => 'success',
                        'prévu' => 'info',
                        'en attente' => 'secondary',
                        'terminé' => 'dark',
                        'annulé' => 'danger'
                    ];
                @endphp
                <span class="badge bg-{{ $colors[$rendezvous->statut] ?? 'secondary' }}">
                    {{ ucfirst($rendezvous->statut) }}
                </span>
            </p>
            <p><strong>Motif :</strong> {{ $rendezvous->motif ?? 'Aucun' }}</p>
        </div>
    </div>

    <a href="{{ route('rendezvous.index') }}" class="btn btn-secondary mt-4">⬅ Retour à la liste</a>
    <a href="{{ route('rendezvous.recu', $rendezvous->id) }}" class="btn btn-outline-primary mt-4">📄 Télécharger reçu PDF</a>
</div>
@endsection
