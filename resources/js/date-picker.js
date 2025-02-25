import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
import { Lithuanian } from 'flatpickr/dist/l10n/lt.js';

console.log('Date picker module loaded');

document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM loaded, initializing flatpickr");

    // Check if date picker elements exist on the page
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');

    console.log("Start date input found:", !!startDateInput);
    console.log("End date input found:", !!endDateInput);

    if (!startDateInput || !endDateInput) {
        console.log("Date inputs not found, exiting initialization");
        return;
    }

    // Define unavailable dates (can be loaded from backend)
    const unavailableDates = [
        // Add dates that should be disabled
        // Format: "YYYY-MM-DD"
    ];

    // Common configuration options
    const commonConfig = {
        dateFormat: "Y-m-d",
        minDate: "today",
        locale: Lithuanian,
        disable: unavailableDates,
        disableMobile: false,
        allowInput: true
    };

    console.log("Initializing date pickers with config:", commonConfig);

    // Initialize start date picker
    let startDatePicker, endDatePicker;

    try {
        startDatePicker = flatpickr(startDateInput, {
            ...commonConfig,
            onChange: function(selectedDates, dateStr) {
                console.log("Start date changed:", dateStr);
                // Update end date min date when start date changes
                if (selectedDates[0] && endDatePicker) {
                    endDatePicker.set("minDate", dateStr);

                    // Clear end date if it's before start date
                    if (endDatePicker.selectedDates[0] &&
                        endDatePicker.selectedDates[0] < selectedDates[0]) {
                        endDatePicker.clear();
                    }
                }

                updateDateSummary();
            }
        });

        console.log("Start date picker initialized successfully");

        // Initialize end date picker
        endDatePicker = flatpickr(endDateInput, {
            ...commonConfig,
            onChange: function(selectedDates) {
                console.log("End date changed:", selectedDates);
                updateDateSummary();
            }
        });

        console.log("End date picker initialized successfully");
    } catch (error) {
        console.error("Error initializing flatpickr:", error);
    }

    /**
     * Updates the date summary section with selected dates
     * and calculates the total number of days
     */
    function updateDateSummary() {
        const summary = document.getElementById('date-summary');

        if (!summary) {
            console.log("Summary element not found");
            return;
        }

        const startDate = startDatePicker?.selectedDates[0];
        const endDate = endDatePicker?.selectedDates[0];

        console.log("Updating summary with dates:", startDate, endDate);

        if (startDate && endDate) {
            // Show the summary section
            summary.classList.remove('hidden');

            // Format dates using Lithuanian locale
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            const startFormatted = startDate.toLocaleDateString('lt-LT', options);
            const endFormatted = endDate.toLocaleDateString('lt-LT', options);

            // Calculate total days
            const timeDiff = endDate - startDate;
            const daysDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24)) + 1;

            // Get Lithuanian word form for days (diena, dienos, dienų)
            const dayWord = getDayWordForm(daysDiff);

            // Update summary elements
            document.getElementById('summary-start-date').textContent = startFormatted;
            document.getElementById('summary-end-date').textContent = endFormatted;
            document.getElementById('total-days').textContent = `${daysDiff} ${dayWord}`;

            console.log("Summary updated successfully");
        } else {
            // Hide summary if dates are not complete
            summary.classList.add('hidden');
        }
    }

    /**
     * Returns the correct Lithuanian word form for days based on count
     * @param {number} count - Number of days
     * @return {string} - Correct word form (diena, dienos, dienų)
     */
    function getDayWordForm(count) {
        // Lithuanian rules for days
        if (count % 10 === 0 || (count % 100 >= 11 && count % 100 <= 19)) {
            return "dienų";
        } else if (count % 10 === 1) {
            return "diena";
        } else if (count % 10 >= 2 && count % 10 <= 9) {
            return "dienos";
        } else {
            return "dienų";
        }
    }

    // Add event listener for form submission
    const bookingForm = document.querySelector('form');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(event) {
            // Validate dates before submission
            if (!startDatePicker.selectedDates[0] || !endDatePicker.selectedDates[0]) {
                event.preventDefault();

                // Show error message
                const errorMessage = document.createElement('div');
                errorMessage.className = 'text-red-500 text-sm mt-2';
                errorMessage.textContent = 'Prašome pasirinkti abi datas.';

                // Remove any existing error messages
                const existingError = document.querySelector('.text-red-500');
                if (existingError) {
                    existingError.remove();
                }

                // Add error message after the date inputs
                const dateContainer = document.querySelector('.date-range-container');
                dateContainer.appendChild(errorMessage);
            }
        });
    }

    // Initialize any other date-related functionality
    initializeAdditionalDateFeatures();

    /**
     * Initialize any additional date-related features
     * This can be extended based on specific requirements
     */
    function initializeAdditionalDateFeatures() {
        // Example: Add a "clear dates" button functionality
        const clearButton = document.getElementById('clear-dates');
        if (clearButton) {
            clearButton.addEventListener('click', function() {
                startDatePicker.clear();
                endDatePicker.clear();
                updateDateSummary();
            });
        }

        // Add any additional date-related features here
    }
});
