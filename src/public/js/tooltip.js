/**
 * Initializes Bootstrap tooltips for all elements in the DOM that have the 'data-bs-toggle="tooltip"' attribute.
 */
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));