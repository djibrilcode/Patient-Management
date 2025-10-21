<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu Rendez-vous #{{ $rendezvous->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; padding: 30px; }
        h1 { color: #007bff; }
        .section { margin-bottom: 20px; }
        .label { font-weight: bold; }
        .value { margin-left: 10px; }
        hr { border: 1px solid #007bff; margin: 20px 0; }
    </style>
</head>
<body>
    <h1>Reçu du Rendez-vous</h1>
    <div class="d-flex align-items-center mb-2">
    <span class="fw-bold text-muted me-2">Rendez-vous N°:</span>
    <span class="fw-bold text-primary">
        RDV-{{ str_pad($rendezvous->id, 5, '0', STR_PAD_LEFT) }}
    </span>
</div>

    <hr>

    <div class="section">
        <span class="label">Patient:</span>
        <span class="value">{{ $rendezvous->patient->nom }} {{ $rendezvous->patient->prenom }}</span>
    </div>

    <div class="section">
        <span class="label">Médecin:</span>
        <span class="value">{{ $rendezvous->medecin->nom }} {{ $rendezvous->medecin->prenom }}</span>
    </div>

    <div class="section">
        <span class="label">Date:</span>
        <span class="value">{{ \Carbon\Carbon::parse($rendezvous->date)->format('d/m/Y') }}</span>
    </div>

    <div class="section">
        <span class="label">Heure:</span>
        <span class="value">{{ \Carbon\Carbon::parse($rendezvous->heure)->format('H:i') }}</span>
    </div>

    <div class="section">
        <span class="label">Statut:</span>
        <span class="value">{{ ucfirst($rendezvous->statut) }}</span>
    </div>

    <hr>

    <footer style="text-align:center; font-size:0.8em; color:#999;">
        &copy; {{ date('Y') }} Cabinet Médical - Tous droits réservés
    </footer>
</body>
</html>
