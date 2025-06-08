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
    <div class="min-h-screen py-6 sm:py-8 lg:py-12">
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
            <div class="text-center mb-8">
                <div class="inline-block p-4 bg-white rounded-full shadow-md mb-4">
                    <img src="{{ asset('images/clients/client1/logo1.png') }}" alt="Logo Vivet" class="h-20 w-auto">
                </div>
                <h1 class="text-3xl font-bold text-teal-800 md:text-4xl lg:text-5xl">Vivet</h1>
                <p class="mt-2 text-gray-600">Crea tu cuenta para acceder a nuestros servicios</p>
            </div>

            @if ($errors->any())
            <div class="mx-auto max-w-screen-md mb-6">
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md">
                    <div class="flex items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-semibold">Por favor corrige los siguientes errores:</span>
                    </div>
                    <ul class="list-disc list-inside pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <!-- form - start -->
            <div class="mx-auto max-w-screen-md">
                <form class="bg-white rounded-2xl shadow-xl overflow-hidden" method="POST" action="{{ route('register.submit') }}" autocomplete="off">
                    @csrf
                    <div class="p-6 md:p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Registro de Usuario</h2>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" name="nombre" placeholder="Juan" value="{{ old('nombre') }}" class="w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 bg-gray-50 text-gray-800 outline-none ring-teal-300 transition duration-200 focus:ring focus:border-teal-500" />
                                </div>
                            </div>

                            <div>
                                <label for="apellido" class="block text-sm font-medium text-gray-700 mb-2">Apellido</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" name="apellido" placeholder="Pérez" value="{{ old('apellido') }}" class="w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 bg-gray-50 text-gray-800 outline-none ring-teal-300 transition duration-200 focus:ring focus:border-teal-500" />
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>
                                    <input type="email" name="email" placeholder="correo@ejemplo.com" value="{{ old('email') }}" class="w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 bg-gray-50 text-gray-800 outline-none ring-teal-300 transition duration-200 focus:ring focus:border-teal-500" />
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="run" class="block text-sm font-medium text-gray-700 mb-2">RUN (sin puntos ni dígito verificador)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zm-1 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" name="run" placeholder="12345678" minlength="7" maxlength="8" value="{{ old('run') }}" class="w-full pl-10 pr-3 py-3 rounded-lg border border-gray-300 bg-gray-50 text-gray-800 outline-none ring-teal-300 transition duration-200 focus:ring focus:border-teal-500" />
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Contraseña (8-15 caracteres)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="password" name="password" id="password" minlength="8" maxlength="15" autocomplete="new-password" oninput="validatePassword()" class="w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 bg-gray-50 text-gray-800 outline-none ring-teal-300 transition duration-200 focus:ring focus:border-teal-500" />
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
                                <!-- <ul id="password-rules">
                                    <li id="length" class="text-danger">Mínimo 8 caracteres</li>
                                    <li id="upper-lower" class="text-danger">Mayúsculas y minúsculas</li>
                                    <li id="number" class="text-danger">Al menos un número</li>
                                    <li id="symbol" class="text-danger">Al menos un símbolo</li>
                                </ul> -->
                            </div>

                            <div class="sm:col-span-2">
                                <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-2">Confirmar Contraseña</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="password" name="password_confirmation" id="confirmPassword" minlength="8" maxlength="15" class="w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 bg-gray-50 text-gray-800 outline-none ring-teal-300 transition duration-200 focus:ring focus:border-teal-500" />
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <button type="button" id="toggleConfirmPassword" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                            <!-- Eye icon (show password) -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" id="showConfirmPasswordIcon" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                            <!-- Eye-slash icon (hide password) - initially hidden -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" id="hideConfirmPasswordIcon" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                                                <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-center sm:col-span-2 mt-4">
                                <button type="submit" style="background-color: var(--color-button-secondary);" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Crear cuenta
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 border-t border-gray-200 flex items-center justify-center">
                        <p class="text-center text-sm text-gray-600">¿Ya tienes una cuenta?
                            <a href="{{ route('login') }}" class="font-medium text-teal-600 hover:text-teal-500 transition duration-150 ease-in-out">
                                Inicia sesión aquí
                            </a>
                        </p>
                    </div>
                </form>
            </div>
            <!-- form - end -->

            <!-- Decorative elements -->
            <div class="mt-12 text-center text-gray-500 text-sm">
                <p>© {{ date('Y') }} Clínica Veterinaria. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Setup toggle for password field
            setupPasswordToggle('password', 'togglePassword', 'showPasswordIcon', 'hidePasswordIcon');

            // Setup toggle for confirm password field
            setupPasswordToggle('confirmPassword', 'toggleConfirmPassword', 'showConfirmPasswordIcon', 'hideConfirmPasswordIcon');

            // Function to setup password toggle functionality
            function setupPasswordToggle(inputId, toggleId, showIconId, hideIconId) {
                const passwordInput = document.getElementById(inputId);
                const toggleButton = document.getElementById(toggleId);
                const showPasswordIcon = document.getElementById(showIconId);
                const hidePasswordIcon = document.getElementById(hideIconId);

                if (passwordInput && toggleButton && showPasswordIcon && hidePasswordIcon) {
                    toggleButton.addEventListener('click', function() {
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
                }
            }
        });

        function validatePassword() {
            const password = document.getElementById("password").value;
            const length = password.length >= 8 && password.length <= 15;
            const upper = /[A-Z]/.test(password);
            const lower = /[a-z]/.test(password);
            const number = /\d/.test(password);
            // const symbol = /[^A-Za-z0-9]/.test(password);

            document.getElementById("length").className = length ? "text-success" : "text-danger";
            document.getElementById("upper-lower").className = (upper && lower) ? "text-success" : "text-danger";
            document.getElementById("number").className = number ? "text-success" : "text-danger";
            // document.getElementById("symbol").className = symbol ? "text-success" : "text-danger";
        }
    </script>

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