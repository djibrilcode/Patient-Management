 @extends('layouts.app')

@section('content')
    @include('components.alerts')

    <x-index-table
        icon="bi bi-file-medical-fill"
        title="Gestion des Spécialités"
        :createRoute="route('specialites.create')"
        :searchAction="route('specialites.index')"
        :columns="[
            'nom' => 'nom',
          
            
        ]"
        :data="$specialites"
        resource="specialites"
    />
@endsection