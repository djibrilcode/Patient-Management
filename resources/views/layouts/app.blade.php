<!DOCTYPE html>
<html lang="fr" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Système de gestion du cabinet médical">
    <title>@yield('title', 'Tableau de bord') - Cabinet Médical</title>
    
    <!-- Preload des assets critiques -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" as="style">
    <link rel="preload" href="{{ asset('css/app.css') }}" as="style">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- Styles personnalisés -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" media="screen">

     <link rel="preload" href="{{ asset('js/app.js') }}" as="script">

       <script src="{{ asset('js/ajax-navigation.js') }}" defer></script>
    
    @stack('styles')
    <style>
             footer {
        background-color: #2c3e50;
        color: white;
    }
    </style>
</head>
<body class="dashboard-body">
    <!-- Navigation -->
    @include('partials.navbar')
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-3 col-lg-2 sidebar-container d-print-none">
                @include('partials.sidebar')
            </aside>
            
            <!-- Content Area -->
            <main class="col-md-9 col-lg-10 main-content" role="main">
                <!-- Gestion des notifications flash avec SweetAlert -->
                @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        showSuccessAlert("{{ session('success') }}");
                    });
                </script>
                @endif
                
                @if(session('error'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        showErrorAlert("{{ session('error') }}");
                    });
                </script>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Footer optionnel -->
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
                        <li><i class="fas fa-envelope me-2"></i><a href="#" >codelive0227@gmail.com</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 MediCare Pro. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" 
            crossorigin="anonymous"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    
    <!-- Scripts personnalisés -->
    <script>
        // Configuration globale de SweetAlert2
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
        
        // Fonctions globales pour les notifications
        window.showSuccessAlert = (message) => {
            Toast.fire({
                icon: 'success',
                title: message
            });
        };
        
        window.showErrorAlert = (message) => {
            Toast.fire({
                icon: 'error',
                title: message
            });
        };
        
        // Fonction de confirmation avant suppression
        window.confirmDelete = (formId, title = 'Êtes-vous sûr?', text = "Cette action est irréversible!") => {
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        };

        // Initialisation au chargement du DOM
        document.addEventListener('DOMContentLoaded', function() {
            // Tooltips Bootstrap
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Fermeture automatique des alertes Bootstrap après 5 secondes
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    bootstrap.Alert.getInstance(alert)?.close();
                }, 5000);
            });
            
            // Gestion des formulaires de suppression
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    confirmDelete(form.id);
                });
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>