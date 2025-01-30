/**
 * Initializes the confirmation modal functionality on page load.
 * Ensures that when the modal is shown, it updates the confirmation message
 * and sets up a click event listener on the confirmation button.
 */
document.addEventListener('DOMContentLoaded', function () {
    const confirmationModal = document.getElementById('confirmation-modal');

    confirmationModal.addEventListener('show.bs.modal', function (event) {
        const deleteButton = event.relatedTarget;
        const confirmationButton = confirmationModal.querySelector('#confirmation-button');
        const confirmationMessage = confirmationModal.querySelector('#confirmation-message');

        confirmationMessage.textContent = deleteButton.dataset.message;
        confirmationButton.addEventListener('click', function () {
            window.location.href = deleteButton.dataset.href;
        });
    });
});
