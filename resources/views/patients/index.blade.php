@extends('layouts.app')

@section('content')
    @include('components.alerts')

    <x-index-table
        icon="bi-person"
        title="Liste des Patients"
        :createRoute="route('patients.create')"
        :searchAction="route('patients.index')"
        :columns="['Nom' => 'nom', 'Prénom' => 'prenom', 'Date de naissance' => 'date_naissance']"
        :data="$patients"
        resource="patients"
    />
@endsection
