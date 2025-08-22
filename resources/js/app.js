import './bootstrap';

import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import { Lithuanian } from "flatpickr/dist/l10n/lt.js";

// Make it available globally
window.flatpickr = flatpickr;
window.flatpickrLithuanian = Lithuanian;
