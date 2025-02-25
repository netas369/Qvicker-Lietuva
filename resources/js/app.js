import './bootstrap';

// Import flatpickr
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
// Import Lithuanian locale
import { Lithuanian } from "flatpickr/dist/l10n/lt.js";

// Make flatpickr available globally if needed
window.flatpickr = flatpickr;

// Import your date picker module
import './date-picker.js';


// import Alpine from 'alpinejs';
//
// window.Alpine = Alpine;
//
// Alpine.start();
