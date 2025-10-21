 @extends('layouts.app')

@section('content')
    @include('components.alerts')

  <x-index-table
    icon="bi bi-file-medical-fill"
    title="Gestion des Préscriptions"
    :createRoute="route('prescriptions.create')"
    :searchAction="route('prescriptions.index')"
    :columns="[
        'ID' => 'id',
        'Médecin' => 'medecin.nom',
        'Patient' => 'patient.nom',
        'ID Consult' => 'consultation.id',
        'Motif Consult' => 'consultation.motif',
        'Date' => 'date_prescription',
        'Instructions' => 'instructions'
    ]"
    :data="$prescriptions"
    resource="prescriptions"
/>

@endsection
