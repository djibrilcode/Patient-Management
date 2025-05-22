<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCare Pro | À propos</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Styles spécifiques à la page À propos */
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(25, 135, 84, 0.1);
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(25, 135, 84, 0.1) !important;
        }
        .team-card {
            transition: all 0.3s ease;
        }
        .team-card:hover {
            transform: scale(1.05);
        }
        .team-card img {
            border: 3px solid rgba(25, 135, 84, 0.2);
            transition: all 0.3s ease;
        }
        .team-card:hover img {
            border-color: rgba(25, 135, 84, 0.5);
        }
        .icon-wrapper {
            transition: all 0.3s ease;
        }
        .feature-card:hover .icon-wrapper {
            background-color: rgba(25, 135, 84, 0.2) !important;
        }
    </style>
</head>
<body>
    <!-- Header avec menu horizontal -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #198754;">
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
                            <a class="nav-link" href="#"><i class="fas fa-home"></i> Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="apropos"><i class="fas fa-info-circle"></i> À propos</a>
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
                                <a href="{{ route('login') }}" class="nav-link">
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
                                    <button type="submit" class="nav-link" style="background: none; border: none;">
                                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                                    </button>
                                </form>
                            </li>
                            @endauth
                        </ul>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contenu de la page À propos -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-success text-white">
                        <h2 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>À propos de MediCare Pro
                        </h2>
                    </div>
                    <div class="card-body">
                        <!-- ... (le reste du contenu de votre page À propos reste inchangé) ... -->
                        <div class="row align-items-center mb-5">
                            <div class="col-md-6">
                                <img src="https://images.unsplash.com/photo-1581056771107-24ca5f033842?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                     alt="Cabinet médical" class="img-fluid rounded">
                            </div>
                            <div class="col-md-6">
                                <h3 class="text-success">Notre Mission</h3>
                                <p class="lead">
                                    Révolutionner la gestion des cabinets médicaux grâce à une solution tout-en-un intuitive et sécurisée.
                                </p>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-12">
                                <h3 class="text-success mb-4">
                                    <i class="fas fa-star me-2"></i>Nos Fonctionnalités
                                </h3>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="feature-card p-4 h-100 rounded shadow-sm">
                                            <div class="icon-wrapper bg-success bg-opacity-10 rounded-circle mb-3" style="width: 60px; height: 60px;">
                                                <i class="fas fa-calendar-check text-success fs-3"></i>
                                            </div>
                                            <h4>Gestion de RDV</h4>
                                            <p>Planification intelligente et rappels automatiques pour vos patients.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="feature-card p-4 h-100 rounded shadow-sm">
                                            <div class="icon-wrapper bg-success bg-opacity-10 rounded-circle mb-3" style="width: 60px; height: 60px;">
                                                <i class="fas fa-file-medical text-success fs-3"></i>
                                            </div>
                                            <h4>Dossiers Patients</h4>
                                            <p>Stockage sécurisé et accès instantané aux historiques médicaux.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="feature-card p-4 h-100 rounded shadow-sm">
                                            <div class="icon-wrapper bg-success bg-opacity-10 rounded-circle mb-3" style="width: 60px; height: 60px;">
                                                <i class="fas fa-chart-line text-success fs-3"></i>
                                            </div>
                                            <h4>Analytique</h4>
                                            <p>Tableaux de bord complets pour suivre l'activité de votre cabinet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="team-section">
                            <h3 class="text-success mb-4">
                                <i class="fas fa-users me-2"></i>Notre Équipe
                            </h3>
                            <div class="row">
                                <div class="col-md-3 mb-4">
                                    <div class="team-card text-center p-3">
                                        <img src="https://randomuser.me/api/portraits/women/44.jpg" 
                                             class="rounded-circle mb-3" width="120" alt="Dr. Sophie Martin">
                                        <h5>Dr. Sophie Martin</h5>
                                        <p class="text-muted">Médecin Directrice</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="team-card text-center p-3">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                                             class="rounded-circle mb-3" width="120" alt="Pierre Lambert">
                                        <h5>Pierre Lambert</h5>
                                        <p class="text-muted">Développeur Principal</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="team-card text-center p-3">
                                        <img src="https://randomuser.me/api/portraits/women/68.jpg" 
                                             class="rounded-circle mb-3" width="120" alt="Émilie Duval">
                                        <h5>Émilie Duval</h5>
                                        <p class="text-muted">Responsable Support</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <div class="team-card text-center p-3">
                                        <img src="https://randomuser.me/api/portraits/men/75.jpg" 
                                             class="rounded-circle mb-3" width="120" alt="Thomas Leroy">
                                        <h5>Thomas Leroy</h5>
                                        <p class="text-muted">Expert RGPD</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>