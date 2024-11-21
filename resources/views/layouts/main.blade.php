<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Include Tailwind compiled by Vite -->
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-800">
<div class="container mx-auto px-4">
    @yield('content')
</div>
</body>


    @yield('script')
</html>
