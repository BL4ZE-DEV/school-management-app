<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title inertia>{{ config('app.name', 'School Management') }}</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @inertiaHead
</head>

<body class="bg-gray-100">
    @inertia
</body>
</html>