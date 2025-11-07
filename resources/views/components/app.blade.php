<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Floral App' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="d-flex flex-column  bg-indigo-100 min-vh-100">

    {{-- Slot Navbar --}}
    {{ $navbar ?? '' }}

    {{-- Main content --}}
    <main class="container mx-auto py-4 flex-grow-1">
        {{ $slot }}
    </main>

    {{-- Slot Footer --}}
    {{ $footer ?? '' }}

</body>
</html>
