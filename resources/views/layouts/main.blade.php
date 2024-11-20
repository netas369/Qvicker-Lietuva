<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Include Tailwind compiled by Vite -->
    @vite('resources/css/app.css')
</head>
<body>
@yield('content')
</body>
</html>
