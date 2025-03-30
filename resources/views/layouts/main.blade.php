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
    <iframe
        src="https://cdn.lottielab.com/l/4snxnQuvEVEVwB.html"
        class="lottie-iframe h-[150px] md:h-[250px] lg:h-[350px]"
        frameborder="0"
        title="City skyline animation"
        loading="lazy"
    ></iframe>
</div>

@include('layouts.footer')

<!-- Scripts -->
{{--<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>--}}
@stack('scripts')

@yield('script')
</body>
</html>
