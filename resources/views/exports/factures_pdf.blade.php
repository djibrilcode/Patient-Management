<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Export des Factures</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .footer { margin-top: 20px; font-size: 0.8em; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Export des Factures</h2>
        <p>Généré le: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>N° Facture</th>
                <th>Patient</th>
                <th>Montant</th>
                <th>Statut</th>
                <th>Date Création</th>
            </tr>
        </thead>
        <tbody>
            @foreach($factures as $facture)
            <tr>
                <td>FAC-{{ str_pad($facture->id, 6, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $facture->consultation->patient->nom }} {{ $facture->consultation->patient->prenom }}</td>
                <td>{{ number_format($facture->montant, 2) }} DH</td>
                <td>
                    @if($facture->statut_paiement == 'payé')
                        Payé
                    @elseif($facture->statut_paiement == 'partiel')
                        Partiel
                    @else
                        Impayé
                    @endif
                </td>
                <td>{{ $facture->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Factures: {{ $factures->count() }}</p>
        <p>Montant Total: {{ number_format($factures->sum('montant'), 2) }} DH</p>
    </div>
</body>
</html>