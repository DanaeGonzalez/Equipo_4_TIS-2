<!-- Franja superior -->
<div class="bg-[var(--color-accent-1)] text-white text-sm py-2">
    <div class="mx-auto max-w-screen-xl px-4 flex justify-between items-center">
        <span>
            📞 Contáctanos: +56 9 4251 3361
        </span>
        <span>
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
        <a href="#" class="text-lg font-semibold text-gray transition duration-100 hover:underline">Contacto</a>
        <a href="#" class="text-lg font-semibold text-gray transition duration-100 hover:underline">Equipo</a>
      </nav>
      <!-- nav - end -->

      <!-- buttons - start (en caso de estar autenticado) -->
      @auth
      <form method="post" action="{{ route('logout') }}" class="-ml-8 hidden flex-col gap-2.5 sm:flex-row sm:justify-center lg:flex lg:justify-start">
        @csrf
        <button type="submit" class="inline-block rounded-lg px-4 py-3 text-center text-sm font-semibold text-gray-500 outline-none ring-indigo-300 transition duration-100 hover:text-indigo-500 focus-visible:ring active:text-indigo-600 md:text-base">Cerrar Sesión</>
      </form>
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
