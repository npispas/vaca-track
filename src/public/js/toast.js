/**
 * Initializes Bootstrap toast when the DOM content is fully loaded.
 * Ensures that the toast element is detected and displayed if present.
 */
document.addEventListener('DOMContentLoaded', () => {
    const toastElement = document.querySelector('.toast');

    if (toastElement) {
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastElement);
        toastBootstrap.show();
    }
});