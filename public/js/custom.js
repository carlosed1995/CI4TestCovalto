/**
 * Function to handle the delete modal event  
 */  
document.addEventListener('DOMContentLoaded', function() {
    const deleteModal = document.getElementById('deleteModal')
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const url = button.getAttribute('data-bs-url')
            // Update the modal's content.
            const form = deleteModal.querySelector('#delete-item') 
            // Check if the 'delete-item' form element exists
            if (form) { 
                form.setAttribute('action', url);
            } 
        })
    }
});
