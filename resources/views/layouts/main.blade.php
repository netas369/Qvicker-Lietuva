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

</head>
<body class="bg-gray-50 text-gray-800">
@include('layouts.navbar')

<div class="container mx-auto px-4">
    @yield('content')
</div>

@include('layouts.footer')

<!-- Scripts -->
{{--<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>--}}
@stack('scripts')

@yield('script')
</body>
</html>
