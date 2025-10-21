 @extends('layouts.app')

@section('content')
    @include('components.alerts')

    <x-index-table
        icon="bi bi-file-medical-fill"
        title="Gestion des Rendez-vous"
        :createRoute="route('rendezvous.create')"
        :searchAction="route('rendezvous.index')"
        :columns="[
            'Medecin' => 'medecin.nom',
            'Patient' => 'patient.nom',
            'Date' => 'date',
            'Heure' => 'heure',
            'Statut' => 'statut',
            
        ]"
        :data="$rendezvous"
        resource="rendezvous"
    />
@endsection
