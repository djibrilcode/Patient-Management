<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture #{{ str_pad($facture->id_facture, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        @page {
            margin: 30px 35px;
            size: A4;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #2c3e50;
            line-height: 1.4;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        /* Évite les coupures de page */
        * {
            page-break-inside: avoid;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #3498db;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }

        .header h2 {
            color: #2980b9;
            margin: 0;
            font-size: 20px;
        }

        .company-info {
            font-size: 12px;
            color: #555;
            line-height: 1.3;
        }

        .section-title {
            background-color: #3498db;
            color: white;
            padding: 5px 8px;
            margin-top: 10px;
            font-weight: bold;
            border-radius: 4px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        th, td {
            border: 1px solid #bdc3c7;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #3498db;
            color: #fff;
        }

        .amount {
            text-align: right;
            font-weight: bold;
        }

        .status {
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 8px;
        }

        .status.payé { color: #27ae60; }
        .status.partiel { color: #f39c12; }
        .status.impayé { color: #e74c3c; }

        .signature-section {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .signature {
            width: 40%;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin-top: 30px;
            padding-top: 4px;
            font-size: 12px;
            text-align: center;
        }

        .footer {
            margin-top: 25px;
            font-size: 11px;
            text-align: center;
            color: #7f8c8d;
        }

        hr {
            border: none;
            border-top: 1px solid #3498db;
            margin: 10px 0;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <h2>Clinique MediCare Pro</h2>
        <p class="company-info">
            Avenue de la Santé, Quartier Médical – Niamey, Niger<br>
            Téléphone : +227 90 00 00 00 | Email : contact@medicarepro.com
        </p>
        <hr>
        <h3>Facture N° {{ str_pad($facture->id,6,'0',STR_PAD_LEFT) }}</h3>
        <p>Date d’émission : {{ $facture->created_at?->format('d/m/Y') ?? 'Non renseigné' }}</p>
    </div>

    <!-- INFORMATIONS DU PATIENT -->
    <div class="section-title">Informations du patient</div>
    <table>
        <tr>
            <th>Nom complet</th>
            <td>{{ $facture->consultation?->patient?->nom }} {{ $facture->consultation?->patient?->prenom }}</td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td>{{ $facture->consultation?->patient?->adresse ?? '—' }}</td>
        </tr>
        <tr>
            <th>Téléphone</th>
            <td>{{ $facture->consultation?->patient?->telephone ?? '—' }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $facture->consultation?->patient?->email ?? '—' }}</td>
        </tr>
    </table>

    <!-- INFORMATIONS CONSULTATION -->
    <div class="section-title">Détails de la consultation</div>
    <table>
        <tr>
            <th>Date consultation</th>
            <td>{{ $facture->consultation?->date_consultation ?? '—' }}</td>
        </tr>
        <tr>
            <th>Médecin</th>
            <td>Dr. {{ $facture->consultation?->medecin?->nom ?? '—' }}</td>
        </tr>
        <tr>
            <th>Traitement</th>
            <td>{{ $facture->consultation?->traitement ?? '—' }}</td>
        </tr>
    </table>

    <!-- DÉTAILS FACTURE -->
    <div class="section-title">Détails de la facture</div>
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Montant (FCFA)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $facture->description ?? 'Consultation médicale' }}</td>
                <td class="amount">{{ number_format($facture->montant, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <p class="status {{ strtolower($facture->statut_paiement) }}">
        <strong>Statut :</strong> {{ ucfirst($facture->statut_paiement) ?? 'Non spécifié' }}
    </p>

    @if($facture->mode_paiement)
        <p><strong>Mode de paiement :</strong> {{ ucfirst($facture->mode_paiement) }}</p>
    @endif

    @if($facture->date_paiement)
        <p><strong>Date de paiement :</strong> {{ $facture->date_paiement->format('d/m/Y') }}</p>
    @endif

    <!-- SIGNATURES -->
    <div class="signature-section">
        <div class="signature">
            <div class="signature-line">Signature du patient</div>
        </div>
        <div class="signature">
            <div class="signature-line">Signature de l’émetteur</div>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <hr>
        <p>Clinique MediCare Pro — Service de facturation</p>
        <p>&copy; {{ date('Y') }} Tous droits réservés</p>
    </div>

</body>
</html>
