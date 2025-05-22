<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCare Pro | Gestion de Cabinet Médical</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <style>
    /* Style personnalisé */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    
    .hero-section {
        /* Correction: séparation du gradient et de l'image de fond */
        background: 
            linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
            url('https://images.unsplash.com/photo-1579684453423-f84349ef60b0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center;
        background-size: cover;
        color: white;
        padding: 120px 0;
        text-align: center;
        flex-grow: 1;
        display: flex;
        align-items: center;
    }
    
    .navbar {
        background-color: #198754 !important;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
    }
    
    .navbar-brand i {
        margin-right: 10px;
    }
    
    .btn-cta {
        background-color: #ff6b35;
        border: none;
        padding: 10px 25px;
        font-weight: 600;
    }
    
    .btn-cta:hover {
        background-color: #e65a2b;
    }
    
    footer {
        background-color: #2c3e50;
        color: white;
    }
    
</style>
</head>
<body>
    <!-- Header avec menu horizontal -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-heartbeat"></i>MediCare Pro
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#"><i class="fas fa-home"></i> Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="apropos"><i class="fas fa-info-circle"></i> À propos</a>
                        </li>
                       <li class="nav-item">
    <a class="nav-link" href="/dashboard"><i class="fas fa-chart-line"></i> Dashboard</a>
</li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact"><i class="fas fa-envelope"></i> Contact</a>
                        </li>
                <ul class="navbar-nav ms-auto">
        @guest
        <li class="nav-item mx-1">
          <a href="{{ route('login') }}" class="nav-link active">
          <i class="fas fa-user"></i>
            <span>Connexion</span>
          </a>
        </li>
        @endguest
        
        @auth

   
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
                <button type="submit" class="nav-link active">
                 <i class="fas fa-user"></i>Déconnexion
                </button>
              </form>
            </li>
          </ul>
        </li>
        @endauth
      </ul>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contenu principal avec image de fond -->
    <main class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Optimisez votre cabinet médical</h1>
                    <p class="lead mb-5">
                        MediCare Pro est la solution complète pour gérer efficacement votre pratique médicale.
                        Prise de rendez-vous, gestion des dossiers patients, les consultations et facturation simplifiée
                        dans une plateforme sécurisée et conforme RGPD.
                    </p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                        <a href="#" class="btn btn-cta btn-lg px-4 gap-3">
                            <i class="fas fa-play"></i> Découvrir la démo
                        </a>
                        <a href="{{  route('login') }}" class="btn btn-outline-light btn-lg px-4">
                            <i class="fas fa-user-md"></i> Se connecter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-heartbeat"></i> MediCare Pro</h5>
                    <p>La solution innovante pour les professionnels de santé.</p>
                </div>
                <div class="col-md-3">
                    <h5>Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Mentions légales</a></li>
                        <li><a href="#" class="text-white">CGU</a></li>
                        <li><a href="#" class="text-white">Confidentialité</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contact</h5>
                    <ul class="list-unstyled">
                         <li><i class="fas fa-phone me-2"></i> +212 61115 5307</li>
                        <li><i class="fas fa-envelope me-2"></i> codelive0227@gmail.com</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 MediCare Pro. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>