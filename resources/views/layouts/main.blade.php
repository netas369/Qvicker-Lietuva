<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <!-- Updated styles to fix horizontal scroll -->
    <style>
        /* Fix for full-width elements to prevent horizontal scrolling */
        body {
            overflow-x: hidden; /* Prevent horizontal scroll */
        }

        .lottie-container {
            position: relative;
            width: 100%;  /* Use percentage instead of viewport width */
            overflow: hidden;
        }

        .lottie-iframe {
            width: 100%;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
@include('layouts.navbar')

{{--<div class="container mx-auto px-4">--}}
    @yield('content')
{{--</div>--}}

<!-- Updated Lottie animation container -->
<div class="lottie-container">
    <div
        id="footer-lottie-container"
        class="h-[150px] md:h-[250px] lg:h-[350px] xl:h-[350px]"
    ></div>
</div>

@include('layouts.footer')

<!-- Scripts -->
@stack('scripts')

<!-- Lottie library and initialization -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const footerAnimationContainer = document.getElementById('footer-lottie-container');

        if (footerAnimationContainer) {
            lottie.loadAnimation({
                container: footerAnimationContainer,
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: '/animations/lottie_footer.json'
            });
        }
    });
</script>


@if (session('error'))
    <div id="error-popup" class="fixed top-4 right-4 z-50 max-w-md bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg" role="alert">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button id="close-error-popup" class="inline-flex bg-red-100 text-red-500 rounded-md p-1.5 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session('success'))
    <div id="success-popup" class="fixed top-4 right-4 z-50 max-w-md bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg" role="alert">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button id="close-success-popup" class="inline-flex bg-green-100 text-green-500 rounded-md p-1.5 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

@yield('script')

<!-- Script to close error pop ups automatically -->
<script>
    // Function to close error popup
    function closeErrorPopup() {
        const errorPopup = document.getElementById('error-popup');
        if (errorPopup) {
            errorPopup.style.opacity = '0';
            setTimeout(() => {
                errorPopup.style.display = 'none';
            }, 300);
        }
    }

    // Function to close success popup
    function closeSuccessPopup() {
        const successPopup = document.getElementById('success-popup');
        if (successPopup) {
            successPopup.style.opacity = '0';
            setTimeout(() => {
                successPopup.style.display = 'none';
            }, 300);
        }
    }

    // Add event listeners when the DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        // Add transition effect to popups
        const errorPopup = document.getElementById('error-popup');
        const successPopup = document.getElementById('success-popup');

        if (errorPopup) {
            errorPopup.style.transition = 'opacity 0.3s ease-in-out';

            // Add click event to close button
            const closeButton = document.getElementById('close-error-popup');
            if (closeButton) {
                closeButton.addEventListener('click', closeErrorPopup);
            }

            // Auto-dismiss after 5 seconds
            setTimeout(closeErrorPopup, 5000);
        }

        if (successPopup) {
            successPopup.style.transition = 'opacity 0.3s ease-in-out';

            // Add click event to close button
            const closeButton = document.getElementById('close-success-popup');
            if (closeButton) {
                closeButton.addEventListener('click', closeSuccessPopup);
            }

            // Auto-dismiss after 5 seconds
            setTimeout(closeSuccessPopup, 5000);
        }
    });
</script>

@include('components.cookie-banner')
</body>
</html>
