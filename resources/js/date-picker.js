import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
import { Lithuanian } from 'flatpickr/dist/l10n/lt.js';

console.log('Calendar module loaded');

document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM loaded, initializing calendar");

    // Check if calendar container exists
    const calendarContainer = document.getElementById('calendar-container');

    if (!calendarContainer) {
        console.log("Calendar container not found, exiting initialization");
        return;
    }

    // Store state
    let currentMode = 'select'; // 'select' or 'unavailable'
    let selectedDates = [];
    let unavailableDates = [];

    // Setup buttons
    const selectDatesBtn = document.getElementById('select-dates-btn');
    const markUnavailableBtn = document.getElementById('mark-unavailable-btn');

    // Detect screen size
    const isMobile = window.innerWidth < 768;

    // Initialize calendar with responsive settings
    const calendar = flatpickr(calendarContainer, {
        inline: true,
        mode: "range",
        dateFormat: "Y-m-d",
        minDate: "today",
        locale: Lithuanian,
        showMonths: isMobile ? 1 : 2, // Show fewer months on mobile
        static: true,
        onChange: function(dates, dateStr) {
            if (currentMode === 'select') {
                handleSelectDates(dates);
            } else {
                handleMarkUnavailable(dates);
            }
        },
        onReady: function() {
            // Add custom styling to the calendar for better visibility
            const calendarElem = calendar.calendarContainer;
            calendarElem.classList.add('border', 'rounded-lg', 'shadow-md');
        }
    });

    // Initialize button states
    selectDatesBtn.classList.add('bg-blue-600', 'text-white');
    markUnavailableBtn.classList.add('bg-white', 'text-gray-700');

    // Mode switching
    selectDatesBtn.addEventListener('click', function() {
        currentMode = 'select';
        updateButtonStates();

        // Clear existing selection
        calendar.clear();

        // Update calendar configuration
        calendar.set('mode', 'range');
    });

    markUnavailableBtn.addEventListener('click', function() {
        currentMode = 'unavailable';
        updateButtonStates();

        // Clear existing selection
        calendar.clear();

        // Update calendar configuration
        calendar.set('mode', 'multiple');
    });

    function updateButtonStates() {
        if (currentMode === 'select') {
            selectDatesBtn.classList.remove('bg-white', 'text-gray-700');
            selectDatesBtn.classList.add('bg-blue-600', 'text-white');

            markUnavailableBtn.classList.remove('bg-blue-600', 'text-white');
            markUnavailableBtn.classList.add('bg-white', 'text-gray-700');
        } else {
            markUnavailableBtn.classList.remove('bg-white', 'text-gray-700');
            markUnavailableBtn.classList.add('bg-blue-600', 'text-white');

            selectDatesBtn.classList.remove('bg-blue-600', 'text-white');
            selectDatesBtn.classList.add('bg-white', 'text-gray-700');
        }
    }

    function handleSelectDates(dates) {
        if (dates.length === 2) {
            selectedDates = [...dates];

            // Update hidden inputs
            document.getElementById('start_date').value = flatpickr.formatDate(dates[0], "Y-m-d");
            document.getElementById('end_date').value = flatpickr.formatDate(dates[1], "Y-m-d");

            // Update the summary
            updateDateSummary(dates[0], dates[1]);

            // Show submit button
            const submitContainer = document.getElementById('submit-container');
            if (submitContainer) {
                submitContainer.classList.remove('hidden');
            }
        }
    }

    function handleMarkUnavailable(dates) {
        // Update unavailable dates collection
        unavailableDates = [...dates];

        // Store as JSON in hidden input for form submission
        document.getElementById('unavailable_dates').value = JSON.stringify(
            unavailableDates.map(date => flatpickr.formatDate(date, "Y-m-d"))
        );

        // Show submit button for saving unavailable dates
        const submitContainer = document.getElementById('submit-container');
        if (submitContainer) {
            submitContainer.classList.remove('hidden');
        }

        // Optionally show a message about the marked dates
        console.log(`Marked ${unavailableDates.length} dates as unavailable`);
    }

    function updateDateSummary(startDate, endDate) {
        const summary = document.getElementById('date-summary');

        if (!summary) {
            console.log("Summary element not found");
            return;
        }

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
            const startDateValue = document.getElementById('start_date').value;
            const endDateValue = document.getElementById('end_date').value;
            const unavailableDatesValue = document.getElementById('unavailable_dates').value;

            // Validate dates before submission based on current mode
            if (currentMode === 'select' && (!startDateValue || !endDateValue)) {
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

                // Add error message after the calendar
                calendarContainer.parentNode.appendChild(errorMessage);
            } else if (currentMode === 'unavailable' && (!unavailableDatesValue || unavailableDatesValue === '[]')) {
                event.preventDefault();

                // Show error message
                const errorMessage = document.createElement('div');
                errorMessage.className = 'text-red-500 text-sm mt-2';
                errorMessage.textContent = 'Prašome pažymėti bent vieną datą.';

                // Remove any existing error messages
                const existingError = document.querySelector('.text-red-500');
                if (existingError) {
                    existingError.remove();
                }

                // Add error message after the calendar
                calendarContainer.parentNode.appendChild(errorMessage);
            }
        });
    }

    // Add a clear dates button if needed
    const clearButton = document.getElementById('clear-dates');
    if (clearButton) {
        clearButton.addEventListener('click', function() {
            calendar.clear();
            document.getElementById('start_date').value = '';
            document.getElementById('end_date').value = '';
            document.getElementById('unavailable_dates').value = '';
            const summary = document.getElementById('date-summary');
            if (summary) {
                summary.classList.add('hidden');
            }
            const submitContainer = document.getElementById('submit-container');
            if (submitContainer) {
                submitContainer.classList.add('hidden');
            }
        });
    }

    // Handle window resize to adjust calendar if needed
    window.addEventListener('resize', function() {
        const newIsMobile = window.innerWidth < 768;

        // Only update if the screen size category changed
        if (newIsMobile !== isMobile) {
            // Preserve current selection
            const currentSelection = calendar.selectedDates;

            // Update the number of months shown
            calendar.set('showMonths', newIsMobile ? 1 : 2);

            // Restore selection if there was any
            if (currentSelection && currentSelection.length > 0) {
                calendar.setDate(currentSelection);
            }
        }
    });
});
