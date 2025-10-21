
@extends('layouts.app')

@section('content')
    @include('components.alerts')

    <x-index-table
        icon="bbi bi-plus-circle"
        title="Liste des Medecaments"
        :createRoute="route('medicaments.create')"
        :searchAction="route('medicaments.index')"
        :columns="['nom' => 'nom', 'description' => 'description']"
        :data="$medicaments"
        resource="medicaments"
    />
@endsection