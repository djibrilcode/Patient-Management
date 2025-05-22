// Dans votre fichier app.js ou dans une balise script

document.addEventListener('DOMContentLoaded', function() {
    // 1. Intercepter tous les clics sur les liens
    document.body.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (!link) return;
        
        // Exclure les liens externes, les liens avec target="_blank", etc.
        if (link.href && 
            !link.href.startsWith('javascript:') && 
            !link.target && 
            link.hostname === window.location.hostname &&
            !link.hasAttribute('data-no-ajax')) {
            e.preventDefault();
            loadPage(link.href, true);
        }
    });

    // 2. Gérer le bouton retour/avant du navigateur
    window.addEventListener('popstate', function() {
        loadPage(window.location.href, false);
    });

    // 3. Fonction principale de chargement de page
    async function loadPage(url, pushState) {
        try {
            // Afficher un indicateur de chargement
            showLoadingIndicator();

            // Récupérer le contenu via AJAX
            const response = await fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            
            if (!response.ok) throw new Error('Erreur de chargement');
            
            const html = await response.text();
            
            // Parser le HTML reçu
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            // Extraire les parties à mettre à jour
            const title = doc.querySelector('title').innerText;
            const mainContent = doc.querySelector('main').innerHTML;
            const sidebar = doc.querySelector('aside')?.innerHTML;
            
            // Mettre à jour le DOM
            document.title = title;
            document.querySelector('main').innerHTML = mainContent;
            if (sidebar) {
                document.querySelector('aside').innerHTML = sidebar;
            }
            
            // Mettre à jour l'historique
            if (pushState) {
                history.pushState({}, '', url);
            }
            
            // Déclencher les événements personnalisés
            const event = new CustomEvent('pageLoaded', { 
                detail: { url, title } 
            });
            document.dispatchEvent(event);
            
        } catch (error) {
            console.error('Erreur:', error);
            // En cas d'erreur, rechargement complet
            window.location.href = url;
        } finally {
            hideLoadingIndicator();
        }
    }

    // 4. Fonctions utilitaires
    function showLoadingIndicator() {
        // Créer ou afficher un indicateur de chargement
        let loader = document.getElementById('ajax-loader');
        if (!loader) {
            loader = document.createElement('div');
            loader.id = 'ajax-loader';
            loader.style.position = 'fixed';
            loader.style.top = '0';
            loader.style.left = '0';
            loader.style.width = '100%';
            loader.style.height = '3px';
            loader.style.backgroundColor = '#198754';
            loader.style.zIndex = '9999';
            loader.style.transition = 'width 0.4s ease';
            document.body.appendChild(loader);
        }
        loader.style.width = '70%';
    }

    function hideLoadingIndicator() {
        const loader = document.getElementById('ajax-loader');
        if (loader) {
            loader.style.width = '100%';
            setTimeout(() => {
                if (loader.parentNode) {
                    loader.parentNode.removeChild(loader);
                }
            }, 300);
        }
    }

    // 5. Gestion des formulaires (optionnel)
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.method.toLowerCase() === 'post' && 
            !form.hasAttribute('data-no-ajax')) {
            e.preventDefault();
            submitForm(form);
        }
    });

    async function submitForm(form) {
        try {
            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: form.method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            if (response.redirected) {
                loadPage(response.url, true);
            } else if (response.ok) {
                const result = await response.json();
                if (result.redirect) {
                    loadPage(result.redirect, true);
                } else {
                    // Traiter la réponse AJAX (mise à jour partielle)
                    console.log('Form submitted successfully', result);
                }
            }
        } catch (error) {
            console.error('Form submission error:', error);
        }
    }
});

// 6. Initialisation des composants après chaque chargement
document.addEventListener('pageLoaded', function() {
    // Réinitialiser les tooltips, les événements, etc.
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Autres initialisations...
});