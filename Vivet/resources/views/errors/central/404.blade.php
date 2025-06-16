<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Página no encontrada')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<section class="" style="background: #fffef2">
    <div class="container min-h-screen px-6 py-12 mx-auto lg:flex lg:items-center lg:gap-12">
        <div class="w-full lg:w-1/2 p-8">
            <p class="text-base font-medium" style="color: #329385;">Error 404</p>
            <h1 class="mt-4 text-3xl font-bold text-gray-800 dark:text-white md:text-5xl">
                Página no encontrada
            </h1>
            <p class="mt-5 text-lg text-gray-600 dark:text-gray-400">
                Lo sentimos, la página que estás buscando no existe. Puedes intentar con uno de los siguientes enlaces:
            </p>

            <div class="flex items-center mt-8 gap-x-4">
                <button
                    class="flex items-center justify-center w-1/2 px-6 py-3 text-base text-gray-700 transition-colors duration-200 bg-green-200 border rounded-lg gap-x-2 sm:w-auto hover:bg-green-300 dark:bg-gray-900 dark:hover:bg-gray-800 dark:text-gray-200 dark:border-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 rtl:rotate-180">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                    <span>Volver</span>
                </button>

                <button
                    class="w-1/2 px-6 py-3 text-base font-semibold tracking-wide text-white transition-colors duration-200 bg-green-700 rounded-lg shrink-0 sm:w-auto hover:bg-green-800 dark:hover:bg-green-500 dark:bg-green-600">
                    Ir al inicio
                </button>
            </div>
        </div>


        <div class="w-full flex justify-center mt-8 lg:mt-0">
            <img src="{{ asset('images/404.png') }}" alt="" class="max-w-full max-h-[32rem] h-auto w-auto">
        </div>

    </div>
</section>
