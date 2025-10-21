@extends('layouts.app')

@section('content')
    @include('components.alerts')

    <x-index-table
        icon="bi-people-fill"
        title="Gestion des Médecins"
        :createRoute="route('medecins.create')"
        :searchAction="route('medecins.index')"
        :columns="[
            'ID' => 'id',
            'Nom' => 'nom',
            'Prénom' => 'prenom',
            'Spécialité' => 'specialite.nom',
            'Téléphone' => 'telephone',
            'Email' => 'email',
        ]"
        :data="$medecins"
        resource="medecins"
    />
@endsection
