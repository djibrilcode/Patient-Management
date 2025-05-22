
// Initialise les composants globaux
import './bootstrap';
import './global';

// Charge les composants spécifiques dynamiquement
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#patientsTable')) {
        import('./modules/patients');
    }
});
// Alert personnalisée pour les succès importants
function showCustomSuccess(title, message) {
    Swal.fire({
        title: title,
        text: message,
        icon: 'success',
        confirmButtonText: 'OK',
        customClass: {
            confirmButton: 'btn btn-success'
        },
        buttonsStyling: false
    });
}

// Alert de confirmation avant une action importante
async function confirmAction(title, text, confirmText = 'Confirmer') {
    const result = await Swal.fire({
        title: title,
        text: text,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: 'Annuler',
        reverseButtons: true
    });
    
    return result.isConfirmed;
}
// Dans votre JS
window.addEventListener('show-delete-confirmation', event => {
    Swal.fire({
        title: event.detail.title,
        text: event.detail.text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Supprimer'
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.emit('deleteConfirmed', event.detail.id);
        }
    });
});