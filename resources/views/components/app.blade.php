<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Floral App' }}</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Caveat:wght@400..700&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Syne:wght@400..800&display=swap" rel="stylesheet">
</head>
<body class="d-flex flex-column  bg-indigo-100 min-vh-100">

    {{-- Slot Navbar --}}
    {{ $navbar ?? '' }}

    {{-- Main content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Slot Footer --}}
    {{-- {{ $footer ?? '' }} --}}
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<script src="//unpkg.com/alpinejs" defer></script>

</body>

</html>
