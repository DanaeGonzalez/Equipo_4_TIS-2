<!-- Franja superior -->
<div class="bg-[var(--color-accent-1)] text-white text-sm py-2">
  <div class="mx-auto max-w-screen-xl px-4 flex flex-col sm:flex-row justify-between items-center gap-2 sm:gap-0 text-center sm:text-left">
    <span class="text-xs sm:text-sm">
      📞 Contáctanos: +56 9 4251 3361
    </span>
    <span class="text-xs sm:text-sm">
      🐾 Clínica Veterinaria Vivet
    </span>
  </div>
</div>

<div class="bg-[var(--color-bg-main)] shadow-md border-b border-gray-200 mb-8">
  <div class="mx-auto max-w-screen-xl px-4 md:px-8">
    <header class="flex items-center justify-between py-3 md:py-4">
      <!-- logo - start -->
      <a href="/" class="inline-flex items-center gap-2.5 text-2xl font-bold text-black md:text-3xl" aria-label="logo">
        <img src="{{ asset('images/clients/client1/logo.png') }}" alt="Logo Vivet" class="h-20 w-auto">
      </a>
      <!-- logo - end -->

      <!-- nav - start -->
      <nav class="hidden gap-12 lg:flex">
        <a href="#" class="text-lg font-semibold text-gray transition duration-100 hover:underline">Inicio</a>
        <a href="#" class="inline-flex items-center gap-1 text-lg font-semibold text-black hover:underline">
          Servicios
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </a>
        <a href="{{ route('contact') }}" class="text-lg font-semibold text-gray transition duration-100 hover:underline">Contacto</a>
        <a href="#" class="text-lg font-semibold text-gray transition duration-100 hover:underline">Equipo</a>
      </nav>
      <!-- nav - end -->

      <!-- buttons - start (en caso de estar autenticado) -->
      @auth
      <!-- Dropdown button -->
      <div class="relative">
        <button id="userDropdownButton" data-dropdown-toggle="userDropdown" class="flex items-center gap-2 rounded-lg px-4 py-3 text-sm font-semibold text-gray-500 outline-none transition duration-100 hover:opacity-80 focus-visible:ring active:opacity-90 md:text-base">
          <!-- User Avatar -->
          <div class="relative w-8 h-8 overflow-hidden bg-gray-100 rounded-full">
            @if(Auth::user()->avatar)
            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
            @else
            <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
            </svg>
            @endif
          </div>
          <span>{{ Auth::user()->name }}</span>
          <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
          </svg>
        </button>

        <!-- Dropdown menu with increased z-index -->
        <div id="userDropdown" class="z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
          <div class="px-4 py-3 text-sm text-gray-900">
            <div class="font-medium">{{ Auth::user()->name }}</div>
            <div class="truncate">{{ Auth::user()->email }}</div>
          </div>
          <ul class="py-2 text-sm text-gray-700" aria-labelledby="userDropdownButton">
            <li>
              <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                <!-- Profile Icon -->
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Perfil
              </a>
            </li>

            <!-- Administrator Panel Button - Only visible for Administrators -->
            @if(Auth::user()->user_type == 'Administrador')
            <li>
              <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                <!-- Admin Panel Icon -->
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Panel de Administración
              </a>
            </li>
            @endif

            <li>
              <form method="post" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full text-left px-4 py-2 hover:bg-gray-100">
                  <!-- Logout Icon -->
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                  </svg>
                  Cerrar Sesión
                </button>
              </form>
            </li>
          </ul>
        </div>
      </div>

      <!-- (en caso de no estar autenticado) -->
      @else
      <div class="-ml-8 hidden flex-col gap-2.5 sm:flex-row sm:justify-center lg:flex lg:justify-start">
        <a href="{{ route('login') }}" class="inline-block rounded-lg px-4 py-3 text-center text-sm font-semibold text-white transition duration-100 hover:opacity-80 md:text-base"
          style="background-color: var(--color-button-secondary)">
          Iniciar Sesión
        </a>

        <a href="{{ route('register') }}" class="inline-block rounded-lg px-8 py-3 text-center text-sm font-semibold text-white transition duration-100 hover:opacity-80 md:text-base"
          style="background-color: var(--color-button-primary)">
          Registrarse
        </a>
      </div>
      @endauth
      <button type="button" class="inline-flex items-center gap-2 rounded-lg bg-white px-2.5 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100 md:text-base lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
        </svg>
        Menu
      </button>
      <!-- buttons - end -->
    </header>
  </div>
</div>