<!-- resources/views/landing.blade.php -->
@extends('layouts.app')

@section('title', 'Inicio - Clínica Veterinaria')

@section('content')

@include('partials.colors')

<!-- CAROUSEL -->

<div id="default-carousel" class="relative w-full" data-carousel="slide" data-carousel-interval="7000">
    <!-- Carousel wrapper -->
    <div class="relative h-64 md:h-96 lg:h-[600px] overflow-hidden rounded-lg">
        <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out relative h-full" data-carousel-item>
            <!-- Imagen de fondo -->
            <img src="{{ asset('images/clients/client1/carousel-1.jpeg') }}"
                class="w-full h-full object-cover" alt="...">

            <!-- Capa de superposición con texto y botón -->
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/40 text-center z-10 p-4 sm:p-6 gap-2 sm:gap-4">
                <h2 class="text-white text-2xl sm:text-4xl font-bold mb-2 sm:mb-4">
                    Bienvenido a la Clínica
                </h2>
                <p class="text-white text-base sm:text-lg mb-4 sm:mb-6">
                    Cuidamos a tu mascota como parte de nuestra familia.
                </p>

                <a href="#contact"
                    class="hover:opacity-90 text-white font-semibold px-4 sm:px-6 py-2 sm:py-3 rounded-lg shadow-lg transition text-sm sm:text-base"
                    style="background-color: var(--color-button-secondary);">
                    Reserva una cita
                </a>


                
            </div>
        </div>

        <!-- Item 2 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('images/clients/client1/carousel-2.jpeg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            <!-- Capa de superposición con texto y botón -->
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/40 text-center z-10 p-4 sm:p-6 gap-2 sm:gap-4">
                <h2 class="text-white text-2xl sm:text-4xl font-bold mb-2 sm:mb-4">
                    Bienvenido a la Clínica
                </h2>
                <p class="text-white text-base sm:text-lg mb-4 sm:mb-6">
                    Cuidamos a tu mascota como parte de nuestra familia.
                </p>

                <a href="#contact"
                    class="hover:opacity-90 text-white font-semibold px-4 sm:px-6 py-2 sm:py-3 rounded-lg shadow-lg transition text-sm sm:text-base"
                    style="background-color: var(--color-button-secondary);">
                    Reserva una cita
                </a>



            </div>
        </div>
        <!-- Item 3 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('images/clients/client1/carousel-3.jpeg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            <!-- Capa de superposición con texto y botón -->
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/40 text-center z-10 p-4 sm:p-6 gap-2 sm:gap-4">
                <h2 class="text-white text-2xl sm:text-4xl font-bold mb-2 sm:mb-4">
                    Bienvenido a la Clínica
                </h2>
                <p class="text-white text-base sm:text-lg mb-4 sm:mb-6">
                    Cuidamos a tu mascota como parte de nuestra familia.
                </p>

                <a href="{{route('appointments.index')}}"
                    class="hover:opacity-90 text-white font-semibold px-4 sm:px-6 py-2 sm:py-3 rounded-lg shadow-lg transition text-sm sm:text-base"
                    style="background-color: var(--color-button-secondary);">
                    Reserva una cita
                </a>



            </div>
        </div>
        <!-- Item 4 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('images/clients/client1/carousel-4.jpeg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            <!-- Capa de superposición con texto y botón -->
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/40 text-center z-10 p-4 sm:p-6 gap-2 sm:gap-4">
                <h2 class="text-white text-2xl sm:text-4xl font-bold mb-2 sm:mb-4">
                    Bienvenido a la Clínica
                </h2>
                <p class="text-white text-base sm:text-lg mb-4 sm:mb-6">
                    Cuidamos a tu mascota como parte de nuestra familia.
                </p>

                <a href="#contact"
                    class="hover:opacity-90 text-white font-semibold px-4 sm:px-6 py-2 sm:py-3 rounded-lg shadow-lg transition text-sm sm:text-base"
                    style="background-color: var(--color-button-secondary);">
                    Reserva una cita
                </a>



            </div>
        </div>
        <!-- Item 5 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('images/clients/client1/carousel-5.jpeg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            <!-- Capa de superposición con texto y botón -->
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/40 text-center z-10 p-4 sm:p-6 gap-2 sm:gap-4">
                <h2 class="text-white text-2xl sm:text-4xl font-bold mb-2 sm:mb-4">
                    Bienvenido a la Clínica
                </h2>
                <p class="text-white text-base sm:text-lg mb-4 sm:mb-6">
                    Cuidamos a tu mascota como parte de nuestra familia.
                </p>

                <a href="#contact"
                    class="hover:opacity-90 text-white font-semibold px-4 sm:px-6 py-2 sm:py-3 rounded-lg shadow-lg transition text-sm sm:text-base"
                    style="background-color: var(--color-button-secondary);">
                    Reserva una cita
                </a>



            </div>
        </div>
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-1/2 left-0 z-30 -translate-y-1/2 px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-1/2 right-0 z-30 -translate-y-1/2 px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

<!-- SECCION DE NOSOTROS -->

<section class="mt-12">
    <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4 md:items-center md:gap-8">
            <div class="md:col-span-3">
                <img
                    src="{{ asset('images/clients/client1/content.jpeg') }}"
                    class="rounded"
                    alt="" />
            </div>

            <div class="md:col-span-1">
                <div class="max-w-lg md:max-w-none">
                    <h2 class="text-2xl font-semibold sm:text-3xl" style="color: var(--color-title);">
                        Profesionales que cuidan con el corazón
                    </h2>


                    <p class="mt-4" style="color: var(--color-text);">
                        Nuestro equipo combina experiencia médica con vocación y cercanía. Cada atención está pensada para que tú y tu mascota se sientan acompañados y seguros durante todo el proceso.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECCION DE SERVICIOS -->

<section class="body-font" style="color: var(--color-text); background-color: var(--color-bg-main);">
    <div class="container px-5 py-24 mx-auto">
        <div class="text-center mb-20">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4"
                style="color: var(--color-title);">
                Nuestros Servicios
            </h1>
            <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto"
                style="color: var(--color-text);">
                Atención médica integral y especializada para el bienestar de tu mascota.
            </p>
            <div class="flex mt-6 justify-center">
                <div class="w-16 h-1 rounded-full inline-flex" style="background-color: var(--color-accent-2);"></div>
            </div>
        </div>

        <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4 md:space-y-0 space-y-6">

            <!-- Item Genérico -->
            @php
            $iconBg = 'var(--color-bg-section)';
            $iconColor = 'white';
            @endphp

            @foreach ([
            ['title' => 'Consulta General', 'text' => 'Evaluación médica veterinaria preventiva y diagnóstica. Incluye revisión completa y recomendaciones personalizadas.', 'image' => 'veterinary.png'],
            ['title' => 'Esterilización', 'text' => 'Procedimiento quirúrgico seguro y eficaz para controlar la reproducción y mejorar la calidad de vida de tu mascota.', 'image' => 'veterinary2.png'],
            ['title' => 'Peluquería', 'text' => 'Baños, cortes, limpieza y cuidados dermatológicos. Ideal para mantener a tu mascota cómoda, saludable y hermosa.', 'image' => 'haircut.png'],
            ] as $item)
            <div class="p-4 md:w-1/3 flex flex-col text-center items-center">
                <div class="w-20 h-20 flex items-center justify-center rounded-full mb-5 flex-shrink-0"
                    style="background-color: {{ $iconBg }};">
                    <img src="{{ asset('images/clients/client1/services/' . $item['image']) }}"
                        alt="{{ $item['title'] }}"
                        class="w-10 h-10 object-contain" />
                </div>
                <div class="flex-grow">
                    <h2 class="text-lg title-font font-medium mb-3" style="color: var(--color-title);">{{ $item['title'] }}</h2>
                    <p class="leading-relaxed text-base" style="color: var(--color-text);">{{ $item['text'] }}</p>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>


<!-- FORMULARIO DE CONTACTO -->

<section class="text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto flex sm:flex-nowrap flex-wrap">
        <div class="lg:w-2/3 md:w-1/2 bg-white rounded-lg overflow-hidden sm:mr-10 p-10 flex items-end justify-start relative min-h-[400px]">
            <iframe
                class="absolute inset-0 w-full h-full rounded-lg"
                frameborder="0"
                style="border:0;"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3355.472097773402!2d-73.0017695!3d-36.8366629!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9669b6ae6d1863a5%3A0x4f6a44d995e49316!2sTreinta%20de%20Octubre%20660%2C%20Concepci%C3%B3n%2C%20B%C3%ADo%20B%C3%ADo!5e0!3m2!1ses!2scl!4v1686345936601!5m2!1ses!2scl">
            </iframe>

            <!-- Tarjeta de información -->
            <div class="bg-white relative flex flex-wrap py-6 rounded shadow-md z-10">
                <div class="lg:w-1/2 px-6">
                    <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">Dirección</h2>
                    <p class="mt-1">30 de octubre 660, Concepción, Chile</p>
                </div>
                <div class="lg:w-1/2 px-6 mt-4 lg:mt-0">
                    <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">EMAIL</h2>
                    <a class="text-indigo-500 leading-relaxed">example@email.com</a>
                    <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs mt-4">Teléfono</h2>
                    <p class="leading-relaxed">+569 4251 3361</p>
                </div>
            </div>
        </div>

        <div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Contáctanos</h2>
            <p class="leading-relaxed mb-5 text-gray-600">
            <p class="leading-relaxed mb-5 text-gray-600">
                ¡Queremos saber de ti! Escríbenos y te ayudaremos con lo que necesites para tu mascota.
            </p>
            </p>
            <div class="relative mb-4">
                <label for="name" class="leading-7 text-sm text-gray-600">Nombre</label>
                <input type="text" id="name" name="name" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <div class="relative mb-4">
                <label for="email" class="leading-7 text-sm text-gray-600">Correo electrónico</label>
                <input type="email" id="email" name="email" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <div class="relative mb-4">
                <label for="message" class="leading-7 text-sm text-gray-600">Mensaje</label>
                <textarea id="message" name="message" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
            </div>
            <button
                style="background-color: var(--color-button-secondary);"
                class="text-white border-0 py-2 px-6 focus:outline-none hover:opacity-90 rounded text-lg">
                Enviar
            </button>
            <p class="text-xs text-gray-500 mt-3">También puedes llamarnos o escribirnos por WhatsApp. Estamos para ayudarte.</p>
        </div>
    </div>
</section>

@endsection