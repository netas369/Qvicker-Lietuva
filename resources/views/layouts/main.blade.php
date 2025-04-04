<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

    {{--    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />--}}

    <!-- Include Tailwind compiled by Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <!-- Custom style to help with iframe positioning -->
    <style>
        .lottie-container {
            width: 100vw;
            margin-left: calc(-50vw + 50%);
            max-width: none;
            overflow: hidden;
            position: relative;
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

<div class="container mx-auto px-4">
    @yield('content')
</div>

<!-- Full-width and centered Lottie animation -->
<div class="lottie-container">
    <div
        id="footer-lottie-container"
        class="h-[150px] md:h-[250px] lg:h-[350px] xl:h-[400px]"
    ></div>
</div>

@include('layouts.footer')

<!-- Scripts -->
{{--<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>--}}
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

@yield('script')
</body>
</html>
