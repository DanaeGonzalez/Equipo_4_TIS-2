<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Clínica Veterinaria')</title>
    <!-- Incluye tu archivo de Tailwind compilado o los links a CDN -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('tenant.partials.colors')

</head>

<body class="flex flex-col min-h-screen">
    {{-- Header --}}
    @include('tenant.partials.header')

    <main class="flex-grow container mx-auto p-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('tenant.partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</body>
</html>
