{{-- resources/views/components/sidebar/dropdown.blade.php --}}
<li class="nav-item">
  <a class="nav-link d-flex align-items-center px-4 py-3 {{ $active ? 'active' : '' }}"
     data-bs-toggle="collapse" href="#{{ $id }}" aria-expanded="{{ $active ? 'true' : 'false' }}">
    <i class="bi {{ $icon }} me-3 text-{{ $color }}"></i>
    <span>{{ $title }}</span>
    <i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <div class="collapse {{ $active ? 'show' : '' }}" id="{{ $id }}">
    <ul class="nav flex-column ps-4">
      {{ $slot }}
    </ul>
  </div>
</li>
