{{-- resources/views/components/sidebar/sublink.blade.php --}}
@props(['route', 'label', 'icon', 'active' => false])

@php
    // Génère l'URL si la route existe, sinon lien vide
    $url = Route::has($route) ? route($route) : '#';
@endphp

<a href="{{ $url }}" class="list-group-item list-group-item-action d-flex align-items-center {{ $active ? 'active' : '' }}">
    <i class="bi {{ $icon }} me-2"></i> {{ $label }}
</a>
