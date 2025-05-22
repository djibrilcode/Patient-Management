<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="{{ route('accueil') }}">
      <i class="bi bi-heart-pulse fs-3 me-2"></i>
      <span class="navbar-title fw-bold fs-4">MediCare Pro</span>
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item mx-1">
          <a href="{{ route('accueil') }}" class="nav-link px-3 d-flex align-items-center">
            <i class="bi bi-house-door me-2"></i>
            <span>Accueil</span>
          </a>
        </li>
        
        @auth
        <li class="nav-item mx-1">
          <a href="{{ route('dashboard.index') }}" class="nav-link px-3 d-flex align-items-center">
            <i class="bi bi-speedometer2 me-2"></i>
            <span>Dashboard</span>
          </a>
        </li>
        @endauth
      </ul>
      
      <ul class="navbar-nav ms-auto">
        @guest
        <li class="nav-item mx-1">
          <a href="{{ route('login') }}" class="nav-link px-3 d-flex align-items-center">
            <i class="bi bi-box-arrow-in-right me-2"></i>
            <span>Connexion</span>
          </a>
        </li>
        
        <li class="nav-item mx-1">
          <a href="#" class="nav-link px-3 d-flex align-items-center">
            <i class="bi bi-person-plus me-2"></i>
            <span>Inscription</span>
          </a>
        </li>
        @endguest
        
        @auth
        <li class="nav-item dropdown mx-1">
          <a class="nav-link dropdown-toggle px-3 d-flex align-items-center" href="#" data-bs-toggle="dropdown">
            <div class="avatar-sm me-2">
              <div class="avatar-title bg-white text-success rounded-circle">
                <i class="bi bi-person-circle fs-5"></i>
              </div>
            </div>
            <span>{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm">
            <li>
              <a class="dropdown-item py-2" href="#">
                <i class="bi bi-person me-2 text-primary"></i> Profil
              </a>
            </li>
            <li>
              <a class="dropdown-item py-2" href="#">
                <i class="bi bi-gear me-2 text-secondary"></i> Paramètres
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
               
                @if($errors->any())
                    <div class="alert alert-danger d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <div>{{ $errors->first() }}</div>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success d-flex align-items-center">
                        <i class="fas fa-check-circle me-2"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item py-2 w-100 text-start bg-transparent border-0">
                  <i class="bi bi-box-arrow-right me-2 text-danger"></i> Déconnexion
                </button>
              </form>
            </li>
          </ul>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<style>
  .avatar-sm {
    width: 30px;
    height: 30px;
  }
  
  .avatar-title {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
  }
  
  .navbar-brand:hover i {
    animation: pulse 1.5s infinite;
  }
  
  @keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
  }
</style>