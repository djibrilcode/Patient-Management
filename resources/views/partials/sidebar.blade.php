<div class="sidebar bg-white shadow-sm d-flex flex-column border-end" style="width: 250px;">

  <div class="sidebar-header text-center py-4 border-bottom bg-light">
    <h5 class="text-success fw-bold">
      <i class="bi bi-hospital me-2"></i> MediCare Pro
    </h5>
  </div>

  <ul class="nav flex-column flex-grow-1">

    {{-- Dashboard --}}
    <li class="nav-item">
      <a href="{{ route('dashboard.index') }}" class="nav-link d-flex align-items-center px-4 py-3 {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
        <i class="bi bi-speedometer2 me-3 text-success"></i> <span>Tableau de bord</span>
      </a>
    </li>

    {{-- Patients --}}
    <x-sidebar.dropdown title="Patients" icon="bi-person-vcard" id="menuPatients" :active="request()->routeIs('patients.*')" color="primary">
      <x-sidebar.sublink route="patients.index" label="Liste des patients" icon="bi-list-ul" :active="request()->routeIs('patients.index')" />
      <x-sidebar.sublink route="patients.create" label="Nouveau patient" icon="bi-person-plus" :active="request()->routeIs('patients.create')" />
      <x-sidebar.sublink route="dossiers.index" label="Dossiers médicaux"  icon="bi bi-folder2-open me-3 text-secondary" :active="request()->routeIs('documents.index')"           />
    </x-sidebar.dropdown>

    {{-- Dossiers médicaux --}}
    <li class="nav-item">
      <a href="{{ route('dossiers.index') }}" class="nav-link d-flex align-items-center px-4 py-3 {{ request()->routeIs('dossiers.*') ? 'active' : '' }}">
        <i class="bi bi-journal-text me-3 text-info"></i> <span>Dossiers patients</span>
      </a>
    </li>

    {{-- Documents patients --}}
    <li class="nav-item">
      <a href="{{ route('documents.index') }}" class="nav-link d-flex align-items-center px-4 py-3 {{ request()->routeIs('documents.*') ? 'active' : '' }}">
        <i class="bi bi-folder2-open me-3 text-secondary"></i> <span>Documents patients</span>
      </a>
    </li>


    {{-- Médecins --}}
    <x-sidebar.dropdown title="Médecins" icon="bi-heart-pulse" id="menuMedecins" :active="request()->routeIs('medecins.*')" color="danger">
      <x-sidebar.sublink route="medecins.index" label="Liste" icon="bi-list-ul" :active="request()->routeIs('medecins.index')" />
      <x-sidebar.sublink route="medecins.create" label="Ajouter" icon="bi-plus-circle" :active="request()->routeIs('medecins.create')" />
      <x-sidebar.sublink route="specialites.index" label="Spécialités" icon="bi bi-tags me-3 text-muted" :active="request()->routeIs('specialites.index')" />
    </x-sidebar.dropdown>

    {{-- Rendez-vous --}}
    <x-sidebar.dropdown title="Rendez-vous" icon="bi-calendar-check" id="menuRDV" :active="request()->routeIs('rendezvous.*')" color="warning">
      <x-sidebar.sublink route="rendezvous.index" label="Liste" icon="bi-list-ul" :active="request()->routeIs('rendezvous.index')" />
      <x-sidebar.sublink route="rendezvous.create" label="Nouveau" icon="bi-plus-circle" :active="request()->routeIs('rendezvous.create')" />
      <x-sidebar.sublink route="rendezvous.calendar" label="Calendrier" icon="bi-calendar-week" :active="request()->routeIs('rendezvous.calendar')" />
    </x-sidebar.dropdown>

    {{-- Consultations --}}
    <x-sidebar.dropdown title="Consultations" icon="bi-journal-medical" id="menuConsultations" :active="request()->routeIs('consultations.*')" color="info">
      <x-sidebar.sublink route="consultations.index" label="Liste" icon="bi-list-ul" :active="request()->routeIs('consultations.index')" />
      <x-sidebar.sublink route="consultations.create" label="Nouvelle" icon="bi-plus-circle" :active="request()->routeIs('consultations.create')" />
    </x-sidebar.dropdown>

    {{-- Médicaments --}}
    <li class="nav-item">
      <a href="{{ route('medicaments.index') }}" class="nav-link d-flex align-items-center px-4 py-3 {{ request()->routeIs('medicaments.*') ? 'active' : '' }}">
        <i class="bi bi-capsule-pill me-3 text-primary"></i> <span>Médicaments</span>
      </a>
    </li>

    {{-- Prescriptions --}}
    <li class="nav-item">
      <a href="{{ route('prescriptions.index') }}" class="nav-link d-flex align-items-center px-4 py-3 {{ request()->routeIs('prescriptions.*') ? 'active' : '' }}">
        <i class="bi bi-file-medical me-3 text-success"></i> <span>Prescriptions</span>
      </a>
    </li>

    {{-- Ordonnances --}}
    <li class="nav-item">
      <a href="{{ route('ordonnances.index') }}" class="nav-link d-flex align-items-center px-4 py-3 {{ request()->routeIs('ordonnances.*') ? 'active' : '' }}">
        <i class="bi bi-clipboard2-pulse me-3 text-success"></i> <span>Ordonnances</span>
      </a>
    </li>

    {{-- Factures --}}
    <li class="nav-item">
      <a href="{{ route('factures.index') }}" class="nav-link d-flex align-items-center px-4 py-3 {{ request()->routeIs('factures.*') ? 'active' : '' }}">
        <i class="bi bi-cash-coin me-3 text-teal"></i> <span>Facturation</span>
      </a>
    </li>

    {{-- Règlements --}}
    <li class="nav-item">
      <a href="{{ route('reglements.index') }}" class="nav-link d-flex align-items-center px-4 py-3 {{ request()->routeIs('reglements.*') ? 'active' : '' }}">
        <i class="bi bi-currency-exchange me-3 text-warning"></i> <span>Règlements</span>
      </a>
    </li>

    {{-- Utilisateurs --}}
    <x-sidebar.dropdown title="Utilisateurs" icon="bi-person-gear" id="menuUsers" :active="request()->routeIs('users.*')" color="dark">
      <x-sidebar.sublink route="users.index" label="Liste" icon="bi-people" :active="request()->routeIs('users.index')" />
      <x-sidebar.sublink route="users.create" label="Ajouter" icon="bi-person-plus" :active="request()->routeIs('users.create')" />
    </x-sidebar.dropdown>

  

    {{-- Déconnexion --}}
    <li class="nav-item mt-auto border-top">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-link d-flex align-items-center px-4 py-3 w-100 bg-transparent border-0">
          <i class="bi bi-box-arrow-right me-3 text-danger"></i> <span>Déconnexion</span>
        </button>
      </form>
    </li>

  </ul>
</div>
