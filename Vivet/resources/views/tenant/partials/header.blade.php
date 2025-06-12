<!-- Franja superior -->
<div class="bg-[var(--color-accent-1)] text-white text-sm py-2">
  <div
    class="mx-auto max-w-screen-xl px-4 flex flex-col sm:flex-row justify-between items-center gap-2 sm:gap-0 text-center sm:text-left">
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
      <!-- Admin Sidebar - Only visible for Administrators -->
      <!-- logo - start -->
      <a href="/" class="inline-flex items-center gap-2.5 text-2xl font-bold text-black md:text-3xl" aria-label="logo">
        <img src="{{ tenant_image('images.logo') }}" alt="Logo" class="h-20 w-auto">
      </a>
      <!-- logo - end -->

      <!-- nav - start -->
      <nav class="hidden gap-12 lg:flex">
        <a href="/" class="text-lg font-semibold text-gray transition duration-100 hover:underline">Inicio</a>
        <a href="#" class="inline-flex items-center mb-2 gap-1 text-lg font-semibold text-black hover:underline">
          Servicios
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
        </a>
        <a href="{{ route('contact') }}"
          class="text-lg font-semibold text-gray transition duration-100 hover:underline">Contacto</a>
        <a href="#" class="text-lg font-semibold text-gray transition duration-100 hover:underline">Equipo</a>

        @auth
        @if(Auth::user()->user_type == 'Administrador')
        <div>
          <!-- Sidebar toggle button -->
          <button data-drawer-target="admin-sidebar" data-drawer-toggle="admin-sidebar" aria-controls="admin-sidebar" type="button"
            class="inline-flex items-center gap-2 p-2 text-sm font-medium text-blue-800 bg-blue-100 rounded-lg hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
            <!-- Admin/Dashboard Icon -->
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
            </svg>
            <span>Panel Admin</span>
          </button>

          <!-- Admin Sidebar -->
          <aside id="admin-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full" aria-label="Admin Sidebar">
            <div class="h-full px-3 py-4 overflow-y-auto bg-blue-50 border-r border-blue-200">
              <!-- Sidebar Header -->
              <div class="flex items-center justify-between mb-6 pb-3 border-b border-blue-200">
                <h2 class="text-xl font-semibold text-brown-700">Panel Admin</h2>
                <button type="button" data-drawer-hide="admin-sidebar" aria-controls="admin-sidebar" class="text-blue-800 bg-transparent hover:bg-blue-100 hover:text-blue-900 rounded-lg text-sm p-1.5">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                  </svg>
                  <span class="sr-only">Close menu</span>
                </button>
              </div>

              <!-- Sidebar Content -->
              <ul class="space-y-2 font-medium">
                <li>
                  <a href="{{ route('products.index') }}" class="flex items-center p-2 text-brown-800 rounded-lg hover:bg-blue-100 group">
                    <!-- Product/Box Icon -->
                    <svg class="w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M17.876.517A1 1 0 0 0 17 0H3a1 1 0 0 0-.871.508A1 1 0 0 0 2 1v18a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V1a.997.997 0 0 0-.124-.483zM10 4a2 2 0 1 1 0 4 2 2 0 0 1 0-4zm5 12H5a1 1 0 0 1 0-2h10a1 1 0 0 1 0 2zm0-4H5a1 1 0 0 1 0-2h10a1 1 0 0 1 0 2zm0-4h-4a1 1 0 0 1 0-2h4a1 1 0 1 1 0 2z" />
                    </svg>
                    <span class="ml-3">Productos</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('inventory.index') }}" class="flex items-center p-2 text-brown-800 rounded-lg hover:bg-blue-100 group">
                    <!-- Product/Box Icon -->
                    <svg class="w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M17.876.517A1 1 0 0 0 17 0H3a1 1 0 0 0-.871.508A1 1 0 0 0 2 1v18a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V1a.997.997 0 0 0-.124-.483zM10 4a2 2 0 1 1 0 4 2 2 0 0 1 0-4zm5 12H5a1 1 0 0 1 0-2h10a1 1 0 0 1 0 2zm0-4H5a1 1 0 0 1 0-2h10a1 1 0 0 1 0 2zm0-4h-4a1 1 0 0 1 0-2h4a1 1 0 1 1 0 2z" />
                    </svg>
                    <span class="ml-3">Inventario</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('services.index') }}" class="flex items-center p-2 text-brown-800 rounded-lg hover:bg-blue-100 group">
                    <!-- Services/Tools Icon -->
                    <svg class="flex-shrink-0 w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M19.728 10.686c-2.38 2.256-6.153 3.381-9.875 3.381-3.722 0-7.4-1.126-9.571-3.371L0 10.437V18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-7.6l-.272.286Z" />
                      <path d="m.135 7.847 1.542 1.417c3.6 3.712 12.747 3.7 16.635.01L19.605 7.9A.98.98 0 0 1 20 7.652V6a2 2 0 0 0-2-2h-3V3a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v1H2a2 2 0 0 0-2 2v1.765c.047.024.092.051.135.082ZM10 10.25a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5ZM7 3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1H7V3Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Servicios</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('exams.index') }}" class="flex items-center p-2 text-brown-800 rounded-lg hover:bg-blue-100 group">
                    <!-- Product/Box Icon -->
                    <svg class="w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M17.876.517A1 1 0 0 0 17 0H3a1 1 0 0 0-.871.508A1 1 0 0 0 2 1v18a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V1a.997.997 0 0 0-.124-.483zM10 4a2 2 0 1 1 0 4 2 2 0 0 1 0-4zm5 12H5a1 1 0 0 1 0-2h10a1 1 0 0 1 0 2zm0-4H5a1 1 0 0 1 0-2h10a1 1 0 0 1 0 2zm0-4h-4a1 1 0 0 1 0-2h4a1 1 0 1 1 0 2z" />
                    </svg>
                    <span class="ml-3">Examenes Médicos</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('roles.index') }}" class="flex items-center p-2 text-brown-800 rounded-lg hover:bg-blue-100 group">
                    <!-- Roles/Shield Icon -->
                    <svg class="flex-shrink-0 w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10 0C4.612 0 0 4.612 0 10s4.612 10 10 10c.528 0 1.046-.043 1.555-.11C5.576 18.734 1.123 7.56 10 0Z" />
                      <path d="M10 0c5.388 0 10 4.612 10 10s-4.612 10-10 10c-.528 0-1.046-.043-1.555-.11C14.424 18.734 18.877 7.56 10 0Z" opacity=".4" />
                      <path d="M10 18.462c4.89-1.425 8.547-5.833 8.547-11.42 0-4.418-2.458-8.273-6.08-10.234C18.347 2.223 15.856 13.825 10 18.462Z" opacity=".4" />
                      <path d="M10 18.462c-4.89-1.425-8.547-5.833-8.547-11.42 0-4.418 2.458-8.273 6.08-10.234C1.653 2.223 4.144 13.825 10 18.462Z" opacity=".4" />
                      <path d="M14 6a1 1 0 0 0-1-1h-1V4a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v1H7a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V6Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Roles</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('users.index') }}" class="flex items-center p-2 text-brown-800 rounded-lg hover:bg-blue-100 group">
                    <!--Users Icon -->
                    <svg class="flex-shrink-0 w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                      <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Usuarios</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('permissions.index') }}" class="flex items-center p-2 text-brown-800 rounded-lg hover:bg-blue-100 group">
                    <!-- Permissions/Lock Icon -->
                    <svg class="flex-shrink-0 w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM5.5 4.002V12h1.283V9.164h1.84c1.896 0 2.877-1.043 2.877-2.915 0-1.895-.993-2.247-3.032-2.247H5.5Zm1.283.976h1.692c.876 0 1.835.22 1.835 1.388 0 1.337-.944 1.815-1.866 1.815h-1.66V4.978Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Permisos</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('appointments.index') }}" class="flex items-center p-2 text-brown-800 rounded-lg hover:bg-blue-100 group">
                    <!-- Appointments/Calendar Icon -->
                    <svg class="flex-shrink-0 w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm14-7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Citas</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('schedules.index') }}" class="flex items-center p-2 text-brown-800 rounded-lg hover:bg-blue-100 group">
                    <!-- Schedules/Clock Icon -->
                    <svg class="flex-shrink-0 w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Agendas</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('pets.index') }}" class="flex items-center p-2 text-brown-800 rounded-lg hover:bg-blue-100 group">
                    <!-- New Pets Icon - Dog Silhouette -->
                    <svg class="flex-shrink-0 w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M15.92 1.01c-.195 0-.392.02-.584.062l-2.712.602a.517.517 0 0 0-.409.506v2.911c0 .586.475 1.06 1.06 1.06h3.232c.586 0 1.06-.474 1.06-1.06V2.13a1.12 1.12 0 0 0-1.12-1.12h-.527ZM7.37 3.839a.517.517 0 0 0-.41-.506L4.25 2.73a2.668 2.668 0 0 0-.585-.062h-.527A1.12 1.12 0 0 0 2.02 3.79v1.302c0 .586.474 1.06 1.06 1.06h3.232c.585 0 1.06-.474 1.06-1.06V3.839ZM17.5 7.721h-1.556a.517.517 0 0 0-.434.235l-.909 1.375c-.109.165-.293.264-.49.264h-.001c-.323 0-.585-.262-.585-.585V7.721H6.06v1.289c0 .323-.262.585-.585.585h-.001a.585.585 0 0 1-.49-.264l-.909-1.375a.517.517 0 0 0-.434-.235H2.086c-.586 0-1.06.474-1.06 1.06v1.556c0 .293.237.53.53.53h.53v7.574c0 .586.474 1.06 1.06 1.06h12.78c.585 0 1.06-.474 1.06-1.06V10.867h.53a.53.53 0 0 0 .53-.53V8.781c0-.586-.474-1.06-1.06-1.06h.014Z" />
                      <path d="M7.37 14.662a1.06 1.06 0 1 0 2.12 0 1.06 1.06 0 0 0-2.12 0Zm3.232 0a1.06 1.06 0 1 0 2.12 0 1.06 1.06 0 0 0-2.12 0Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Mascotas</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('clients.index') }}" class="flex items-center p-2 text-brown-800 rounded-lg hover:bg-blue-100 group">
                    <!-- Clients/People Icon -->
                    <svg class="flex-shrink-0 w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                      <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Clientes</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('billing.index') }}" class="flex items-center p-2 text-brown-800 rounded-lg hover:bg-blue-100 group">
                    <!-- Billing/Receipt Icon -->
                    <svg class="flex-shrink-0 w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M17.222 0H2.778A2.778 2.778 0 0 0 0 2.778v14.444A2.778 2.778 0 0 0 2.778 20h14.444A2.778 2.778 0 0 0 20 17.222V2.778A2.778 2.778 0 0 0 17.222 0ZM5.5 15.556a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm0-4.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm0-4.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm9.5 9h-6a1 1 0 0 1 0-2h6a1 1 0 0 1 0 2Zm0-4.5h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Zm0-4.5h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Facturación</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('clinical_records.index') }}" class="flex items-center p-2 text-brown-800 rounded-lg hover:bg-blue-100 group">
                    <!-- Billing/Receipt Icon -->
                    <svg class="flex-shrink-0 w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-800" fill="currentColor"
                      viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path d="M4 2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.414A2 2 0 0 0 17.414 6L14 2.586A2 2 0 0 0 12.586 2H4zm5 4a1 1 0 0 1 2 0h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0V8H8a1 1 0 1 1 0-2h1zm-3 5h8a1 1 0 1 1 0 2H6a1 1 0 1 1 0-2zm0 3h5a1 1 0 1 1 0 2H6a1 1 0 1 1 0-2z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Ficha Clínica</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('notes.index') }}" class="flex items-center p-2 text-brown-800 rounded-lg hover:bg-blue-100 group">
                    <!-- notes/Receipt Icon -->
                    <svg class="flex-shrink-0 w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-800" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                      <path d="M6 2a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h8a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H6Zm9 3H7v1h8V5Zm0 3H7v1h8V8Zm0 3H7v1h8v-1Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Notas</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('supplies.index') }}" class="flex items-center p-2 text-brown-800 rounded-lg hover:bg-blue-100 group">
                    <!-- Product/Box Icon -->
                    <svg class="w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M17.876.517A1 1 0 0 0 17 0H3a1 1 0 0 0-.871.508A1 1 0 0 0 2 1v18a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V1a.997.997 0 0 0-.124-.483zM10 4a2 2 0 1 1 0 4 2 2 0 0 1 0-4zm5 12H5a1 1 0 0 1 0-2h10a1 1 0 0 1 0 2zm0-4H5a1 1 0 0 1 0-2h10a1 1 0 0 1 0 2zm0-4h-4a1 1 0 0 1 0-2h4a1 1 0 1 1 0 2z" />
                    </svg>
                    <span class="ml-3">Suministros</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('medications.index') }}" class="flex items-center p-2 text-brown-800 rounded-lg hover:bg-blue-100 group">
                    <!-- Product/Box Icon -->
                    <svg class="w-5 h-5 text-blue-700 transition duration-75 group-hover:text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M17.876.517A1 1 0 0 0 17 0H3a1 1 0 0 0-.871.508A1 1 0 0 0 2 1v18a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V1a.997.997 0 0 0-.124-.483zM10 4a2 2 0 1 1 0 4 2 2 0 0 1 0-4zm5 12H5a1 1 0 0 1 0-2h10a1 1 0 0 1 0 2zm0-4H5a1 1 0 0 1 0-2h10a1 1 0 0 1 0 2zm0-4h-4a1 1 0 0 1 0-2h4a1 1 0 1 1 0 2z" />
                    </svg>
                    <span class="ml-3">Medicamentos</span>
                  </a>
                </li>
              </ul>
            </div>
          </aside>
        </div>
        @endif
        @endauth

      </nav>
      <!-- nav - end -->

      <!-- buttons - start (en caso de estar autenticado) -->
      @auth
      <!-- User Dropdown (without admin panel button) -->
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
        <a href="{{ route('login') }}"
          class="inline-block rounded-lg px-4 py-3 text-center text-sm font-semibold text-white transition duration-100 hover:opacity-80 md:text-base"
          style="background-color: var(--color-button-secondary)">
          Iniciar Sesión
        </a>

        <a href="{{ route('register') }}"
          class="inline-block rounded-lg px-8 py-3 text-center text-sm font-semibold text-white transition duration-100 hover:opacity-80 md:text-base"
          style="background-color: var(--color-button-primary)">
          Registrarse
        </a>
      </div>
      @endauth
      <button type="button"
        class="inline-flex items-center gap-2 rounded-lg bg-white px-2.5 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100 md:text-base lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
            clip-rule="evenodd" />
        </svg>
        Menu
      </button>
      <!-- buttons - end -->
    </header>
  </div>
</div>