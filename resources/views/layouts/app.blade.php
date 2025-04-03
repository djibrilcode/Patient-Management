<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestion Cabinet Médical</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Styles personnalisés -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<!-- ... Autres scripts ... -->

<!-- Scripts globaux -->
<script>
    // =============================================
    // 1. FONCTIONS UTILITAIRES GLOBALES
    // =============================================
    
    /**
     * Affiche une confirmation SweetAlert2
     * @param {string} title - Titre de l'alerte
     * @param {string} text - Message de confirmation
     * @returns {Promise} Résultat de la confirmation
     */
    function showConfirm(title, text) {
        return Swal.fire({
            title: title || 'Êtes-vous sûr ?',
            text: text || "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmer'
        });
    }

    /**
     * Gère les erreurs AJAX
     * @param {Error} error - Objet d'erreur
     */
    function handleAjaxError(error) {
        console.error('Erreur AJAX:', error);
        Swal.fire('Erreur !', error.message || 'Une erreur est survenue', 'error');
    }

    // =============================================
    // 2. INITIALISATIONS GLOBALES
    // =============================================
    document.addEventListener('DOMContentLoaded', function() {
        // Active les tooltips Bootstrap partout
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Gestion générique des formulaires de suppression
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                handleDeleteForm(this);
            });
        });
    });

    // =============================================
    // 3. FONCTIONS MÉTIERS GLOBALES
    // =============================================
    
    /**
     * Gère la soumission d'un formulaire de suppression
     * @param {HTMLFormElement} form - Formulaire à traiter
     */
    async function handleDeleteForm(form) {
        try {
            const result = await showConfirm();
            if (!result.isConfirmed) return;

            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ _method: 'DELETE' })
            });

            if (!response.ok) throw new Error(await response.text());

            // Suppression de la ligne du tableau
            form.closest('tr').remove();
            Swal.fire('Supprimé !', '', 'success');
        } catch (error) {
            handleAjaxError(error);
        }
    }

    /**
     * Gère les modals pour création/édition
     * @param {string} modalId - ID du modal
     */
    function initCrudModal(modalId) {
        const modalEl = document.getElementById(modalId);
        if (!modalEl) return;

        const modal = new bootstrap.Modal(modalEl);
        const form = modalEl.querySelector('form');
        
        // Gestion de la soumission
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            try {
                const formData = new FormData(this);
                const method = formData.get('_method') || 'POST';
                
                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                if (!response.ok) throw new Error(await response.text());

                modal.hide();
                Swal.fire('Succès !', 'Opération réussie.', 'success')
                    .then(() => window.location.reload());
            } catch (error) {
                handleAjaxError(error);
            }
        });

        return modal;
    }
</script>

@stack('scripts')
<body>
    <!-- Barre de menu horizontale -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="bi bi-heart-pulse me-2"></i>Cabinet Médical
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="bi bi-house-door me-1"></i> Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-gear me-1"></i> Propriétés</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-envelope me-1"></i> Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Barre de menu verticale -->
            <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <h4 class="px-3 pb-2 border-bottom">Menu</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-speedometer2 me-2"></i> Tableau de bord
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('patients.index') }}">
                                <i class="bi bi-people me-2"></i> Gestion des patients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-calendar-check me-2"></i> Gestion des rendez-vous
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-file-earmark-medical me-2"></i> Gestion des consultations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-receipt me-2"></i> Facturation
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-person-badge me-2"></i> Utilisateurs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-graph-up me-2"></i> Rapports
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Contenu principal -->
            <main class="col-md-9 col-lg-10 px-md-4 py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    &copy; {{ date('Y') }} Cabinet Médical - Tous droits réservés
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-white text-decoration-none me-3">Politique de confidentialité</a>
                    <a href="#" class="text-white text-decoration-none me-3">Conditions d'utilisation</a>
                    <a href="#" class="text-white text-decoration-none">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle avec Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
    <!-- Scripts personnalisés -->
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>