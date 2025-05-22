<div class="col-md-2 sidebar bg-light min-vh-100 shadow-sm" style="background-color: #f8f9fa !important;">
  <div class="sidebar-header text-center py-4">
    <h5 class="mb-0 text-primary">
      <i class="bi bi-hospital me-2"></i> MediCare Pro
    </h5>
  </div>
  
  <ul class="nav flex-column">
    {{-- Dashboard --}}
    <li class="nav-item">
      <a href="{{ route('dashboard.index') }}" class="nav-link sidebar-link d-flex align-items-center py-3 px-4 {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
        <i class="bi bi-speedometer2 me-3 fs-5 text-success"></i>
        <span>Dashboard</span>
        <span class="badge bg-success ms-auto">Nouveau</span>
      </a>
    </li>

    {{-- Patients --}}
    <li class="nav-item">
      <a class="nav-link sidebar-link d-flex align-items-center py-3 px-4 {{ request()->routeIs('patients.*') ? 'active' : '' }}" 
         data-bs-toggle="collapse" href="#menuPatients" aria-expanded="{{ request()->routeIs('patients.*') ? 'true' : 'false' }}">
        <i class="bi bi-people-fill me-3 fs-5 text-primary"></i>
        <span>Patients</span>
        <i class="bi bi-chevron-down ms-auto fs-6"></i>
      </a>
      <div class="collapse {{ request()->routeIs('patients.*') ? 'show' : '' }}" id="menuPatients">
        <ul class="nav flex-column ps-5 py-2">
          <li class="nav-item">
            <a class="nav-link sidebar-sub d-flex align-items-center py-2 {{ request()->routeIs('patients.index') ? 'active' : '' }}" 
               href="{{ route('patients.index') }}">
              <i class="bi bi-list-ul me-2 text-muted"></i>
              <span>Liste des patients</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link sidebar-sub d-flex align-items-center py-2 {{ request()->routeIs('patients.create') ? 'active' : '' }}" 
               href="{{ route('patients.create') }}">
              <i class="bi bi-plus-circle me-2 text-muted"></i>
              <span>Nouveau patient</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link sidebar-sub d-flex align-items-center py-2 {{ request()->routeIs('patients.antecedents') ? 'active' : '' }}" 
               href="#">
              <i class="bi bi-file-medical me-2 text-muted"></i>
              <span>Antécédents</span>
            </a>
          </li>
        </ul>
      </div>
    </li>

    {{-- Médecins --}}
    <li class="nav-item">
      <a class="nav-link sidebar-link d-flex align-items-center py-3 px-4 {{ request()->routeIs('medecins.*') ? 'active' : '' }}" 
         data-bs-toggle="collapse" href="#menuMedecins" aria-expanded="{{ request()->routeIs('medecins.*') ? 'true' : 'false' }}">
        <i class="bi bi-heart-pulse me-3 fs-5 text-danger"></i>
        <span>Médecins</span>
        <i class="bi bi-chevron-down ms-auto fs-6"></i>
      </a>
      <div class="collapse {{ request()->routeIs('medecins.*') ? 'show' : '' }}" id="menuMedecins">
        <ul class="nav flex-column ps-5 py-2">
          <li class="nav-item">
            <a class="nav-link sidebar-sub d-flex align-items-center py-2 {{ request()->routeIs('medecin.index') ? 'active' : '' }}" 
               href="{{ route('medecins.index') }}">
              <i class="bi bi-list-ul me-2 text-muted"></i>
              <span>Liste des médecins</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link sidebar-sub d-flex align-items-center py-2 {{ request()->routeIs('medecin.create') ? 'active' : '' }}" 
               href="{{ route('medecins.create') }}">
              <i class="bi bi-plus-circle me-2 text-muted"></i>
              <span>Ajouter médecin</span>
            </a>
          </li>
        </ul>
      </div>
    </li>

    {{-- Rendez-vous --}}
    <li class="nav-item">
      <a class="nav-link sidebar-link d-flex align-items-center py-3 px-4 {{ request()->routeIs('rendezvous.*') ? 'active' : '' }}" 
         data-bs-toggle="collapse" href="#menuRendezvous" aria-expanded="{{ request()->routeIs('rendezvous.*') ? 'true' : 'false' }}">
        <i class="bi bi-calendar-check me-3 fs-5 text-warning"></i>
        <span>Rendez-vous</span>
        <i class="bi bi-chevron-down ms-auto fs-6"></i>
      </a>
      <div class="collapse {{ request()->routeIs('rendezvous.*') ? 'show' : '' }}" id="menuRendezvous">
        <ul class="nav flex-column ps-5 py-2">
          <li class="nav-item">
            <a class="nav-link sidebar-sub d-flex align-items-center py-2 {{ request()->routeIs('rendezvous.index') ? 'active' : '' }}" 
               href="{{ route('rendezvous.index') }}">
              <i class="bi bi-list-ul me-2 text-muted"></i>
              <span>Liste des RDV</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link sidebar-sub d-flex align-items-center py-2 {{ request()->routeIs('rendezvous.create') ? 'active' : '' }}" 
               href="{{ route('rendezvous.create') }}">
              <i class="bi bi-plus-circle me-2 text-muted"></i>
              <span>Nouveau RDV</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link sidebar-sub d-flex align-items-center py-2 {{ request()->routeIs('rendezvous.calendar') ? 'active' : '' }}" 
               href="#">
              <i class="bi bi-calendar-week me-2 text-muted"></i>
              <span>Calendrier</span>
            </a>
          </li>
        </ul>
      </div>
    </li>

    {{-- Consultations --}}
    <li class="nav-item">
      <a class="nav-link sidebar-link d-flex align-items-center py-3 px-4 {{ request()->routeIs('consultations.*') ? 'active' : '' }}" 
         data-bs-toggle="collapse" href="#menuConsultation" aria-expanded="{{ request()->routeIs('consultations.*') ? 'true' : 'false' }}">
        <i class="bi bi-journal-medical me-3 fs-5 text-info"></i>
        <span>Consultations</span>
        <i class="bi bi-chevron-down ms-auto fs-6"></i>
      </a>
      <div class="collapse {{ request()->routeIs('consultations.*') ? 'show' : '' }}" id="menuConsultation">
        <ul class="nav flex-column ps-5 py-2">
          <li class="nav-item">
            <a class="nav-link sidebar-sub d-flex align-items-center py-2 {{ request()->routeIs('consultations.index') ? 'active' : '' }}" 
               href="{{ route('consultations.index') }}">
              <i class="bi bi-list-ul me-2 text-muted"></i>
              <span>Liste des consultations</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link sidebar-sub d-flex align-items-center py-2 {{ request()->routeIs('consultations.create') ? 'active' : '' }}" 
               href="{{ route('consultations.create') }}">
              <i class="bi bi-plus-circle me-2 text-muted"></i>
              <span>Nouvelle consultation</span>
            </a>
          </li>
        </ul>
      </div>
    </li>

    {{-- Facturation --}}
    <li class="nav-item">
      <a class="nav-link sidebar-link d-flex align-items-center py-3 px-4 {{ request()->routeIs('facturation.*') ? 'active' : '' }}" 
         href="{{route('factures.index')}}">
        <i class="bi bi-receipt me-3 fs-5 text-secondary"></i>
        <span>Facturation</span>
        <span class="badge bg-danger ms-auto"></span>
      </a>
    </li>

    {{-- Utilisateurs (menu déroulant) --}}
<li class="nav-item">
  <a class="nav-link sidebar-link d-flex align-items-center py-3 px-4 collapsed" 
     data-bs-toggle="collapse" 
     href="#users-collapse" 
     aria-expanded="false">
    <i class="bi bi-person-gear me-3 fs-5 text-purple"></i>
    <span>Utilisateurs</span>
    <i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <div class="collapse {{ request()->routeIs('users.*') ? 'show' : '' }}" id="users-collapse">
    <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center py-2 px-4 {{ request()->routeIs('users.index') ? 'active' : '' }}" 
           href="{{ route('users.index') }}">
          <i class="bi bi-list-ul me-3"></i>
          <span>Liste des utilisateurs</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center py-2 px-4 {{ request()->routeIs('users.create') ? 'active' : '' }}" 
           href="{{ route('users.create') }}">
          <i class="bi bi-person-plus me-3"></i>
          <span>Ajouter un utilisateur</span>
        </a>
      </li>
    </ul>
  </div>
</li>

    {{-- Rapports --}}
    <li class="nav-item">
      <a class="nav-link sidebar-link d-flex align-items-center py-3 px-4 {{ request()->routeIs('reports.*') ? 'active' : '' }}" 
         href="#">
        <i class="bi bi-graph-up me-3 fs-5 text-orange"></i>
        <span>Rapports</span>
      </a>
    </li>

    {{-- Déconnexion --}}
    <li class="nav-item mt-auto">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-link sidebar-link d-flex align-items-center py-3 px-4 w-100 bg-transparent border-0">
          <i class="bi bi-box-arrow-right me-3 fs-5 text-danger"></i>
          <span>Déconnexion</span>
        </button>
      </form>
    </li>
  </ul>
</div>

<style>
  .sidebar {
    display: flex;
    flex-direction: column;
    height: 100%;
  }
  
  .sidebar-link {
    transition: all 0.2s ease;
    border-left: 3px solid transparent;
  }
  
  .sidebar-link:hover, 
  .sidebar-link.active {
    background-color: rgba(25, 135, 84, 0.1);
    border-left: 3px solid var(--bs-success);
  }
  
  .sidebar-sub {
    font-size: 0.9rem;
    transition: all 0.2s ease;
  }
  
  .sidebar-sub:hover,
  .sidebar-sub.active {
    background-color: rgba(13, 110, 253, 0.1);
    color: var(--bs-primary) !important;
  }
  
  .text-purple {
    color: #6f42c1;
  }
  
  .text-orange {
    color: #fd7e14;
  }
  
  .sidebar-header {
    border-bottom: 1px solid rgba(0,0,0,0.1);
  }
  
  .sidebar .badge {
    font-size: 0.7rem;
    padding: 0.25rem 0.4rem;
  }
</style>