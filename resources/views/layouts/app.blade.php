<!DOCTYPE html>
<html lang="fr" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Système de gestion du cabinet médical">
    <title>@yield('title', 'Tableau de bord') - Cabinet Médical</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <style>
        body.dashboard-body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-row {
            flex: 1;
        }

        .sidebar-container {
            background-color: #fff;
            border-right: 1px solid #dee2e6;
            box-shadow: 0 0 4px rgba(0,0,0,0.05);
            padding-bottom: 1rem;
            position: sticky;
            top: 0;
            height: 100vh; /* Optionnel si tu veux full height */
            overflow-y: auto;
        }

        main.main-content {
            padding: 1.5rem;
            overflow-x: hidden;
        }

        footer {
            background-color: #2c3e50;
            color: white;
        }
    </style>

    @stack('styles')
</head>
<body class="dashboard-body">
    <!-- Navbar -->
    @include('partials.navbar')

    <div class="container-fluid main-row">
        <div class="row align-items-start">
            <!-- Sidebar -->
            <aside class="col-md-3 col-lg-2 sidebar-container d-print-none">
                @include('partials.sidebar')
            </aside>

            <!-- Main Content -->
            <main class="col-md-9 col-lg-10 main-content" role="main">
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

    <!-- Footer -->
    <footer class="py-4 mt-auto">
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
                        <li><i class="fas fa-envelope me-2"></i><a href="#">codelive0227@gmail.com</a></li>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
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

        window.showSuccessAlert = (message) => Toast.fire({ icon: 'success', title: message });
        window.showErrorAlert = (message) => Toast.fire({ icon: 'error', title: message });

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
                if (result.isConfirmed) document.getElementById(formId).submit();
            });
        };
    </script>

    @stack('scripts')
</body>
</html>
