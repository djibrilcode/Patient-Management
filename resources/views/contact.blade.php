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

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <h2 class="mb-0">
                        <i class="fas fa-envelope me-2"></i>Contactez Notre Équipe
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="text-success mb-4">Informations de Contact</h3>
                            
                            <div class="contact-info mb-4">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="icon-wrapper bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="fas fa-map-marker-alt text-success fs-4"></i>
                                    </div>
                                    <div>
                                        <h5>Adresse</h5>
                                        <p class="mb-0">123 Rue keyna 103 mont fleury<br>75015 Fes, Moroc</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-start mb-3">
                                    <div class="icon-wrapper bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="fas fa-phone-alt text-success fs-4"></i>
                                    </div>
                                    <div>
                                        <h5>Téléphone</h5>
                                        <p class="mb-0">+212 61511 5307<br>Lun-Ven: 9h-18h</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-start mb-3">
                                    <div class="icon-wrapper bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="fas fa-envelope text-success fs-4"></i>
                                    </div>
                                    <div>
                                        <h5>Email</h5>
                                        <p class="mb-0">codelive0227@gmail<br>urgences@medicarepro.fr</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="social-links mt-4">
                                <h5 class="mb-3">Suivez-nous</h5>
                                <a href="#" class="btn btn-outline-success btn-sm me-2 mb-2">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-outline-success btn-sm me-2 mb-2">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-outline-success btn-sm me-2 mb-2">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="btn btn-outline-success btn-sm me-2 mb-2">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h3 class="text-success mb-4">Envoyez-nous un Message</h3>
                            <form>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom Complet</label>
                                    <input type="text" class="form-control" id="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Sujet</label>
                                    <select class="form-select" id="subject">
                                        <option value="support">Support Technique</option>
                                        <option value="demo">Demande de Démo</option>
                                        <option value="billing">Facturation</option>
                                        <option value="other">Autre</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-paper-plane me-2"></i>Envoyer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-body p-0">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.99144060821!2d2.292292615509614!3d48.85837360866186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2964e34e2d%3A0x8ddca9ee380ef7e0!2sTour%20Eiffel!5e0!3m2!1sfr!2sfr!4v1623258136847!5m2!1sfr!2sfr" 
                            width="100%" height="400" style="border:0; border-radius: 0 0 8px 8px;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   </body>
   </html>