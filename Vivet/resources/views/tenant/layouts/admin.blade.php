<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración')</title>

    {{-- Estilos principales --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('tenant.partials.colors')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
</head>

<body class="bg-gray-100 dark:bg-boxdark-2 text-bodydark-1 flex">

    {{-- Sidebar del panel --}}
    @include('tenant.partials.admin.sidebar')

    <div class="flex-1 flex flex-col min-h-screen">

        {{-- Encabezado del panel --}}
        @include('tenant.partials.admin.header')

        {{-- Contenido principal --}}
        <main class="flex-grow p-6">
            @yield('content')
        </main>

        {{-- Footer (opcional) --}}
        {{-- @include('tenant.partials.footer') --}}
    </div>

    {{-- Scripts adicionales --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    
    {{-- Si copias JS de TailAdmin, inclúyelo así: --}}
    {{--
    <script src="{{ asset('assets/js/main.js') }}"></script> --}}
    <script src="{{ asset('assets/js/index.js') }}"></script>

    {{-- Scripts individuales si los necesitas por página --}}
    <script src="{{ asset('assets/js/components/calendar-init.js') }}"></script>
    <script src="{{ asset('assets/js/components/image-resize.js') }}"></script>
    <script src="{{ asset('assets/js/components/map-01.js') }}"></script>
    <script src="{{ asset('assets/js/components/charts/chart-01.js') }}"></script>
    <script src="{{ asset('assets/js/components/charts/chart-02.js') }}"></script>
    <script src="{{ asset('assets/js/components/charts/chart-03.js') }}"></script>

</body>

</html>