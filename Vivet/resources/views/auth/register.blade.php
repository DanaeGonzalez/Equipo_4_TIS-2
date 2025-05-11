<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Clínica Veterinaria')</title>
    <!-- Incluye tu archivo de Tailwind compilado o los links a CDN -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.colors')
</head>

<body>
    <!-- text - start -->
    <div style="background-color: var(--color-bg-section);" class="mb-2 md:mb-2 pb-3 pt-5 shadow-md">
        <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Regístrate</h2>
    </div>
    <!-- text - end -->
    <div class="bg-white py-2 sm:py-4 lg:py-6">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc list-inside pl-4">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- form - start -->
            <form class="mx-auto grid max-w-screen-md gap-3 sm:grid-cols-2 p-5 rounded-lg border shadow-md" method="POST"
                action="{{ route('register.submit') }}">
                @csrf
                <div>
                    <label for="nombre" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">Nombre</label>
                    <input type="text" name="nombre" placeholder="Juan" value="{{ old('nombre') }}"
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-600 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                </div>

                <div>
                    <label for="apellido" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">Apellido</label>
                    <input type="text" name="apellido" placeholder="Pérez" value="{{ old('apellido') }}"
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-600 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                </div>

                <div class="sm:col-span-2">
                    <label for="email" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">Correo</label>
                    <input type="email" name="email" placeholder="correo@ejemplo.com" value="{{ old('email') }}"
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-600 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                </div>

                <div class="sm:col-span-2">
                    <label for="run" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">RUN (sin puntos ni dígito verificador)</label>
                    <input type="text" name="run" placeholder="12345678" value="{{ old('run') }}"
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-600 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                </div>

                <div class="sm:col-span-2">
                    <label for="password"
                        class="mb-2 inline-block text-sm text-gray-800 sm:text-base">Contraseña</label>
                    <input type="password" name="password"
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-600 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                </div>

                <div class="sm:col-span-2">
                    <label for="confirm-password" class="mb-2 inline-block text-sm text-gray-600 sm:text-base">Confirmar
                        Contraseña</label>
                    <input type="password" name="password_confirmation"
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-600 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                </div>

                <div class="flex items-center justify-center sm:col-span-2 mt-2">
                    <button type="submit"
                        style="background-color: var(--color-button-secondary);"
                        class="inline-block rounded-lg px-10 py-4 text-center text-base font-semibold text-white outline-none transition duration-100 hover:opacity-90 focus-visible:ring active:opacity-80 md:text-base">Crear cuenta
                    </button>
                    <!-- <button type="submit" class="inline-block rounded-lg bg-indigo-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base" disabled>Crear cuenta</button> -->

                    <!-- <span class="text-sm text-gray-500">*Required</span> -->
                </div>
                <div class="flex items-center justify-center sm:col-span-2">
                    <p class="text text-gray-600 text-center">Si ya tienes tu cuenta, inicia sesión <a
                            href="{{ route('login') }}"
                            class="underline transition duration-100 hover:text-indigo-500 active:text-indigo-600">aquí</a>.
                    </p>
                </div>
            </form>
            <!-- form - end -->
        </div>
    </div>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $("form").submit(function() {
        $("button[type='submit']").attr('disabled', true);
    });

    $("form").on('ajaxStop', function() {
        $("button[type='submit']").attr('disabled', false);
    });
</script>