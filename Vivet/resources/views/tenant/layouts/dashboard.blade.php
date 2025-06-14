<!-- resources/views/layouts/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Clínica Veterinaria')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        if (
            localStorage.getItem('color-theme') === 'dark' ||
            (!('color-theme' in localStorage) &&
                window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

</head>

<body>

    <body class="bg-gray-100 dark:bg-gray-900">

        {{-- Sidebar + Navbar --}}
        @include('tenant.partials.dashboard.sidebar') {{-- Este incluye TODO el bloque que ya pegaste --}}

        {{-- Contenido principal (Quitar el "border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700" es solo para desarrollo)--}}
        <div class="p-4 sm:ml-64">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                @yield('content')
            </div>
        </div>

    </body>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>

    @yield('scripts')
</body>