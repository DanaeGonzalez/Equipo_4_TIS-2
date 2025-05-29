<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Clínica Veterinaria')</title>
    <!-- Incluye tu archivo de Tailwind compilado o los links a CDN -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.colors')

</head>

<body class="flex flex-col min-h-screen">
    {{-- Header --}}
    @include('partials.header')

    <main class="flex-grow container mx-auto p-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

</body>
</html>
