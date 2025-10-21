@extends('layouts.app')

@section('content')
    @include('components.alerts')

    <x-index-table
        icon="bi-prescription2"
        title="Liste des Ordonnances"
        :createRoute="route('ordonnances.create')"
        :searchAction="route('ordonnances.index')"
        :columns="[
            'Numéro' => 'numero',
            'Date émission' => 'date_emission',
            'Date validité' => 'date_validite',
            'Patient' => 'prescription.patient.nom'
        ]"
        :data="$ordonnances"
        resource="ordonnances"
    />
@endsection
