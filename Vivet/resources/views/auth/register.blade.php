<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Clínica Veterinaria')</title>
    <!-- Incluye tu archivo de Tailwind compilado o los links a CDN -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body>

    <form method="POST" action="{{ route('register.user') }}">
        @csrf

        <div class="bg-white py-6 sm:py-8 lg:py-12">
            <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
                <!-- text - start -->
                <div class="mb-10 md:mb-16">
                    <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Regístrate</h2>

                    <!-- <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">This is a section of some simple filler text, also known as placeholder text. It shares some characteristics of a real written text but is random or otherwise generated.</p> -->
                </div>
                <!-- text - end -->

                <!-- form - start -->
                <form class="mx-auto grid max-w-screen-md gap-4 sm:grid-cols-2">
                    <div>
                        <label for="name" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">Nombre</label>
                        <input type="text" name="name" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                    </div>

                    <div>
                        <label for="last-name" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">Apellido</label>
                        <input type="text" name="last-name" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                    </div>

                    <div class="sm:col-span-2">
                        <label for="email" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">Correo</label>
                        <input type="email" name="email" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                    </div>

                    <div class="sm:col-span-2">
                        <label for="password" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">Contraseña</label>
                        <input type="password" name="password" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                    </div>
                    
                    <div class="sm:col-span-2">
                        <label for="confirm-password" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">Confirmar Contraseña</label>
                        <input type="password" name="confirm-password" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                    </div>
                    
                    <div class="flex items-center justify-between sm:col-span-2 mt-5">
                        <button type="submit" class="inline-block rounded-lg bg-indigo-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base" disabled>Crear cuenta</button>
                        <!-- <button type="submit" class="inline-block rounded-lg bg-indigo-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base" disabled>Crear cuenta</button> -->
                        
                        <!-- <span class="text-sm text-gray-500">*Required</span> -->
                    </div>

                    <p class="text text-gray-400 text-center">Si ya tienes tu cuenta, inicia sesión <a href="#" class="underline transition duration-100 hover:text-indigo-500 active:text-indigo-600">aquí</a>.</p>
                </form>
                <!-- form - end -->
            </div>
        </div>

    </form>

</body>

</html>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $("form").submit(function() {
        $("button[type='submit']").attr('disabled', true);
    });

    $("form").on('ajaxStop', function() {
        $("button[type='submit']").attr('disabled', false);
    });
</script>