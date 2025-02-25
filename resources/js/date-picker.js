import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
import { Lithuanian } from 'flatpickr/dist/l10n/lt.js';

console.log('Calendar module loaded');

document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM loaded, initializing calendar");

    // Robust function to find the calendar container
    function findCalendarContainer() {
        const containers = [
            document.getElementById('calendar-container'),
            document.querySelector('.calendar-container'),
            document.querySelector('[data-calendar]')
        ];

        for (let container of containers) {
            if (container) {
                console.log("Found calendar container:", container);
                return container;
            }
        }

        console.error("No calendar container found. Checked IDs and classes:");
        console.error("- #calendar-container");
        console.error("- .calendar-container");
        console.error("- [data-calendar]");
        return null;
    }

    // Store state
    let currentMode = 'select'; // 'select' or 'unavailable'
    let selectedDates = [];
    let unavailableDates = [];
    let calendar = null;
    let lastIsMobile = window.innerWidth < 768;

    // Find calendar container
    const calendarContainer = findCalendarContainer();
    if (!calendarContainer) {
        console.error("Cannot initialize calendar - no container found");
        return;
    }

    // Load existing unavailable dates
    const existingUnavailableDatesInput = document.getElementById('existing_unavailable_dates');
    let existingUnavailableDates = [];

    if (existingUnavailableDatesInput && existingUnavailableDatesInput.value) {
        try {
            existingUnavailableDates = JSON.parse(existingUnavailableDatesInput.value);
            console.log("Loaded existing unavailable dates:", existingUnavailableDates);
        } catch (e) {
            console.error("Error parsing unavailable dates:", e);
        }
    }

    // Initialize calendar function
    function initCalendar() {
        const isMobile = window.innerWidth < 768;
        console.log(`Initializing calendar for ${isMobile ? 'mobile' : 'desktop'} view`);

        // Safely destroy existing calendar if it exists
        if (calendar && typeof calendar.destroy === 'function') {
            try {
                calendar.destroy();
            } catch (error) {
                console.error("Error destroying previous calendar:", error);
            }
        }

        // Reset calendar variable
        calendar = null;

        try {
            // Create new calendar with appropriate number of months
            calendar = flatpickr(calendarContainer, {
                inline: true,
                mode: currentMode === 'select' ? "range" : "multiple",
                dateFormat: "Y-m-d",
                minDate: "today",
                locale: Lithuanian,
                showMonths: isMobile ? 1 : 2,
                static: true,
                disable: existingUnavailableDates, // Disable already marked unavailable dates
                onChange: function(dates, dateStr) {
                    if (currentMode === 'select') {
                        handleSelectDates(dates);
                    } else {
                        handleMarkUnavailable(dates);
                    }
                },
                onReady: function(selectedDates, dateStr, instance) {
                    console.log("Calendar initialized successfully");
                    // Add custom styling to the calendar for better visibility
                    const calendarElem = instance.calendarContainer;
                    if (calendarElem) {
                        calendarElem.classList.add('border', 'rounded-lg', 'shadow-md');
                    } else {
                        console.warn("Could not find calendar element to style");
                    }
                }
            });

            lastIsMobile = isMobile;
        } catch (error) {
            console.error("Error initializing calendar:", error);
        }
    }

    // Initialize calendar on load
    initCalendar();

    // Add resize handler with debounce
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const isMobile = window.innerWidth < 768;
            if (isMobile !== lastIsMobile) {
                initCalendar();
            }
        }, 250);
    });

    // Initialize button states
    if (selectDatesBtn && markUnavailableBtn) {
        selectDatesBtn.classList.add('bg-blue-600', 'text-white');
        markUnavailableBtn.classList.add('bg-white', 'text-gray-700');

        // Mode switching
        selectDatesBtn.addEventListener('click', function() {
            currentMode = 'select';
            updateButtonStates();

            // Clear existing selection
            if (calendar) calendar.clear();

            // Re-initialize calendar with range mode
            initCalendar();
        });

        markUnavailableBtn.addEventListener('click', function() {
            currentMode = 'unavailable';
            updateButtonStates();

            // Clear existing selection
            if (calendar) calendar.clear();

            // Re-initialize calendar with multiple mode
            initCalendar();
        });
    }

    function updateButtonStates() {
        if (!selectDatesBtn || !markUnavailableBtn) return;

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
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');

            if (startDateInput && endDateInput) {
                startDateInput.value = flatpickr.formatDate(dates[0], "Y-m-d");
                endDateInput.value = flatpickr.formatDate(dates[1], "Y-m-d");

                // Update the summary
                updateDateSummary(dates[0], dates[1]);

                // Show submit button
                const submitContainer = document.getElementById('submit-container');
                if (submitContainer) {
                    submitContainer.classList.remove('hidden');
                }
            }
        }
    }

    function handleMarkUnavailable(dates) {
        // Update unavailable dates collection
        unavailableDates = [...dates];

        // Store as JSON in hidden input for form submission
        const unavailableDatesInput = document.getElementById('unavailable_dates');
        if (unavailableDatesInput) {
            unavailableDatesInput.value = JSON.stringify(
                unavailableDates.map(date => flatpickr.formatDate(date, "Y-m-d"))
            );

            // Show submit button for saving unavailable dates
            const submitContainer = document.getElementById('submit-container');
            if (submitContainer && dates.length > 0) {
                submitContainer.classList.remove('hidden');
            }

            // Optionally show a message about the marked dates
            console.log(`Marked ${unavailableDates.length} dates as unavailable`);
        }
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
            const startDateElement = document.getElementById('summary-start-date');
            const endDateElement = document.getElementById('summary-end-date');
            const totalDaysElement = document.getElementById('total-days');

            if (startDateElement) startDateElement.textContent = startFormatted;
            if (endDateElement) endDateElement.textContent = endFormatted;
            if (totalDaysElement) totalDaysElement.textContent = `${daysDiff} ${dayWord}`;

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
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const unavailableDatesInput = document.getElementById('unavailable_dates');

            const startDateValue = startDateInput ? startDateInput.value : '';
            const endDateValue = endDateInput ? endDateInput.value : '';
            const unavailableDatesValue = unavailableDatesInput ? unavailableDatesInput.value : '';

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
            if (calendar) calendar.clear();

            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const unavailableDatesInput = document.getElementById('unavailable_dates');

            if (startDateInput) startDateInput.value = '';
            if (endDateInput) endDateInput.value = '';
            if (unavailableDatesInput) unavailableDatesInput.value = '';

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
});
