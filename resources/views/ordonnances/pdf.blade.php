<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ordonnance N°{{ $ordonnance->numero }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; line-height: 1.4; }
        h2, h3, h4 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #333; }
        th, td { padding: 5px; text-align: left; }
        .header, .footer { width: 100%; text-align: center; }
        .footer { position: fixed; bottom: 0; font-size: 0.8em; color: #555; }
        .section { margin-bottom: 15px; }
        .section-title { font-weight: bold; margin-bottom: 5px; }
    </style>
</head>
<body>

<div class="header">
    <h2>MediCare Pro</h2>
   <div class="d-flex align-items-center mb-2">
    <span class="fw-bold text-muted me-2">Ordonnance N°:</span>
    <span class="fw-bold text-primary">
        ORD-{{ str_pad($ordonnance->id, 5, '0', STR_PAD_LEFT) }}
    </span>
</div>
</div>

<div class="section">
    <div class="section-title">Informations Générales</div>
    <p><strong>Médecin :</strong> {{ $ordonnance->prescription->medecin->nom }} {{ $ordonnance->prescription->medecin->prenom }}
        @if($ordonnance->prescription->medecin->specialite)
            ({{ $ordonnance->prescription->medecin->specialite->nom }})
        @endif
    </p>
    <p><strong>Patient :</strong> {{ $ordonnance->prescription->patient->nom }} {{ $ordonnance->prescription->patient->prenom }}
        @if($ordonnance->prescription->patient->date_naissance)
            - {{ \Carbon\Carbon::parse($ordonnance->prescription->patient->date_naissance)->age }} ans
        @endif
    </p>
    <p><strong>Date d’émission :</strong> {{ \Carbon\Carbon::parse($ordonnance->date_emission)->format('d/m/Y') }}</p>
    <p><strong>Date de validité :</strong> {{ $ordonnance->date_validite ? \Carbon\Carbon::parse($ordonnance->date_validite)->format('d/m/Y') : 'Non précisé' }}</p>
    <p><strong>Instructions :</strong> {{ $ordonnance->prescription->instructions ?? '-' }}</p>
</div>

<div class="section">
    <div class="section-title">Médicaments prescrits</div>
    @if($ordonnance->prescription->medicaments->isEmpty())
        <p>Aucun médicament spécifié.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Médicament</th>
                    <th>Dosage</th>
                    <th>Durée</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ordonnance->prescription->medicaments as $medicament)
                    <tr>
                        <td>{{ $medicament->nom }}</td>
                        <td>{{ $medicament->pivot->dosage ?? '-' }}</td>
                        <td>{{ $medicament->pivot->duree ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@if($ordonnance->prescription->consultation)
<div class="section">
    <div class="section-title">Historique Consultation</div>
    <p>{{ $ordonnance->prescription->consultation->observations ?? 'Aucune observation.' }}</p>
</div>
@endif

<div class="footer">
    <p>MediCare Pro - La solution innovante pour les professionnels de santé</p>
    <p>Contact : codelive0227@gmail.com | +212 61115 5307</p>
    <p>© 2025 MediCare Pro. Tous droits réservés.</p>
</div>

</body>
</html>
