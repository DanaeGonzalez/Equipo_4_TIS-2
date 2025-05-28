<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Clínica Veterinaria')</title>
    <!-- Incluye tu archivo de Tailwind compilado o los links a CDN -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('tenant.partials.colors')
</head>

<body class="bg-gradient-to-br from-blue-50 to-teal-50">
    <div class="min-h-screen py-4 sm:py-6 lg:py-10 flex items-center justify-center">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8 w-full">
            <!-- Decorative paw prints -->
            <div class="absolute top-10 left-10 opacity-10 hidden lg:block">
                <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="teal" class="transform rotate-12">
                    <path d="M12 2c-5.33 4.55-8 8.48-8 11.8 0 4.98 3.8 8.2 8 8.2s8-3.22 8-8.2c0-3.32-2.67-7.25-8-11.8zm0 18c-3.35 0-6-2.57-6-6.2 0-2.34 1.95-5.44 6-9.14 4.05 3.7 6 6.79 6 9.14 0 3.63-2.65 6.2-6 6.2zm-4.17-6c.37 0 .67.26.74.62.41 2.22 2.28 2.98 3.64 2.87.43-.02.79.32.79.75 0 .4-.32.73-.72.75-2.13.13-4.62-1.09-5.19-4.12-.08-.45.28-.87.74-.87z" />
                </svg>
            </div>
            <div class="absolute bottom-10 right-10 opacity-10 hidden lg:block">
                <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 24 24" fill="teal" class="transform -rotate-12">
                    <path d="M4.5 9.5c-.96 0-1.75.79-1.75 1.75s.79 1.75 1.75 1.75 1.75-.79 1.75-1.75-.79-1.75-1.75-1.75zm5 0c-.96 0-1.75.79-1.75 1.75s.79 1.75 1.75 1.75 1.75-.79 1.75-1.75-.79-1.75-1.75-1.75zm5 0c-.96 0-1.75.79-1.75 1.75s.79 1.75 1.75 1.75 1.75-.79 1.75-1.75-.79-1.75-1.75-1.75zm5 0c-.96 0-1.75.79-1.75 1.75s.79 1.75 1.75 1.75 1.75-.79 1.75-1.75-.79-1.75-1.75-1.75zm-12.5 5c-.96 0-1.75.79-1.75 1.75s.79 1.75 1.75 1.75 1.75-.79 1.75-1.75-.79-1.75-1.75-1.75zm5 0c-.96 0-1.75.79-1.75 1.75s.79 1.75 1.75 1.75 1.75-.79 1.75-1.75-.79-1.75-1.75-1.75zm5 0c-.96 0-1.75.79-1.75 1.75s.79 1.75 1.75 1.75 1.75-.79 1.75-1.75-.79-1.75-1.75-1.75z" />
                </svg>
            </div>

            <!-- Logo and Title -->
            <div class="text-center mb-6">
                <div class="inline-block p-4 bg-white rounded-full shadow-md mb-4">
                    <img src="{{ asset('images/clients/client1/logo1.png') }}" alt="Logo Vivet" class="h-20 w-auto">
                </div>
                <h1 class="text-3xl font-bold text-teal-800 md:text-4xl lg:text-5xl">Vivet</h1>
                <p class="mt-2 text-gray-600">Cuidamos de tus mascotas como si fueran nuestras</p>
            </div>

            @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md mb-4">
                <p class="font-bold">Error:</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="flex justify-center">
                <form class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden" method="post" action="{{ route('login.submit') }}">
                    @csrf
                    <div class="p-6 md:p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Bienvenido de nuevo</h2>

                        <div class="space-y-6">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>
                                    <input type="email" name="email" value="{{ old('email') }}" class="w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 bg-gray-50 text-gray-800 outline-none ring-teal-300 transition duration-200 focus:ring focus:border-teal-500" placeholder="tu@email.com" />
                                </div>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="password" name="password" id="password" maxlength="15" autocomplete="current-password" class="w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 bg-gray-50 text-gray-800 outline-none ring-teal-300 transition duration-200 focus:ring focus:border-teal-500"/>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <button type="button" id="togglePassword" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                            <!-- Eye icon (show password) -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" id="showPasswordIcon" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                            <!-- Eye-slash icon (hide password) - initially hidden -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" id="hidePasswordIcon" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                                                <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                <p class="mt-2 text-sm text-red-600">{{ $errors->first('password') }}</p>
                                @endif
                            </div>

                            <!-- <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                                    <label for="remember-me" class="ml-2 block text-sm text-gray-700">Recordarme</label>
                                </div>
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-teal-600 hover:text-teal-500">¿Olvidaste tu contraseña?</a>
                                </div>
                            </div> -->

                            <button style="background-color: var(--color-button-secondary);" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Iniciar Sesión
                            </button>
                        </div>

                        <!-- <div class="relative flex items-center justify-center">
                            <span class="absolute inset-x-0 h-px bg-gray-300"></span>
                            <span class="relative bg-white px-4 text-sm text-gray-400">Inicia sesión con tu cuenta de Google</span>
                        </div> -->

                        <!-- <button class="flex items-center justify-center gap-2 rounded-lg bg-blue-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-blue-300 transition duration-100 hover:bg-blue-600 focus-visible:ring active:bg-blue-700 md:text-base">
                            <svg class="h-5 w-5 shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 0C5.37273 0 0 5.37273 0 12C0 18.0164 4.43182 22.9838 10.2065 23.8516V15.1805H7.23764V12.0262H10.2065V9.92727C10.2065 6.45218 11.8996 4.92655 14.7878 4.92655C16.1711 4.92655 16.9025 5.02909 17.2489 5.076V7.82945H15.2787C14.0525 7.82945 13.6244 8.99182 13.6244 10.302V12.0262H17.2178L16.7302 15.1805H13.6244V23.8773C19.4815 23.0825 24 18.0747 24 12C24 5.37273 18.6273 0 12 0Z" fill="white" />
                            </svg>

                            Continue with Facebook
                        </button> -->

                        <!-- <button class="flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-8 py-3 text-center text-sm font-semibold text-gray-800 outline-none ring-gray-300 transition duration-100 hover:bg-gray-100 focus-visible:ring active:bg-gray-200 md:text-base">
                            <svg class="h-5 w-5 shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.7449 12.27C23.7449 11.48 23.6749 10.73 23.5549 10H12.2549V14.51H18.7249C18.4349 15.99 17.5849 17.24 16.3249 18.09V21.09H20.1849C22.4449 19 23.7449 15.92 23.7449 12.27Z" fill="#4285F4" />
                                <path d="M12.2549 24C15.4949 24 18.2049 22.92 20.1849 21.09L16.3249 18.09C15.2449 18.81 13.8749 19.25 12.2549 19.25C9.12492 19.25 6.47492 17.14 5.52492 14.29H1.54492V17.38C3.51492 21.3 7.56492 24 12.2549 24Z" fill="#34A853" />
                                <path d="M5.52488 14.29C5.27488 13.57 5.14488 12.8 5.14488 12C5.14488 11.2 5.28488 10.43 5.52488 9.71V6.62H1.54488C0.724882 8.24 0.254883 10.06 0.254883 12C0.254883 13.94 0.724882 15.76 1.54488 17.38L5.52488 14.29Z" fill="#FBBC05" />
                                <path d="M12.2549 4.75C14.0249 4.75 15.6049 5.36 16.8549 6.55L20.2749 3.13C18.2049 1.19 15.4949 0 12.2549 0C7.56492 0 3.51492 2.7 1.54492 6.62L5.52492 9.71C6.47492 6.86 9.12492 4.75 12.2549 4.75Z" fill="#EA4335" />
                            </svg>

                            Continúa con Google
                        </button>
                    </div> -->
                    </div>

                    <div class="bg-gray-50 p-6 border-t border-gray-200 flex items-center justify-center">
                        <p class="text-center text-sm text-gray-600">¿No tienes una cuenta?
                            <a href="{{ route('register') }}" class="font-medium text-teal-600 hover:text-teal-500 transition duration-150 ease-in-out">
                                Regístrate aquí
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Decorative elements -->
            <div class="mt-12 text-center text-gray-500 text-sm">
                <p>© {{ date('Y') }} Clínica Veterinaria Vivet. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const showPasswordIcon = document.getElementById('showPasswordIcon');
            const hidePasswordIcon = document.getElementById('hidePasswordIcon');

            togglePassword.addEventListener('click', function() {
                // Toggle the password visibility
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    showPasswordIcon.classList.add('hidden');
                    hidePasswordIcon.classList.remove('hidden');
                } else {
                    passwordInput.type = 'password';
                    showPasswordIcon.classList.remove('hidden');
                    hidePasswordIcon.classList.add('hidden');
                }
            });
        });
    </script>

</body>

</html>