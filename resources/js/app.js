
// Initialise les composants globaux
import './bootstrap';
import './global';

// Charge les composants spécifiques dynamiquement
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#patientsTable')) {
        import('./modules/patients');
    }
});