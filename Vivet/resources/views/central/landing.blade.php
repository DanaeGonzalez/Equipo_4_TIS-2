<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VetCodex</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100 text-gray-800">

  <!-- Header -->
  <!-- Header -->
  <header class="bg-white shadow py-4">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
      <a href="/" class="flex items-center gap-2 text-2xl font-bold text-[#3a8273]">
        VetCodex
      </a>

      <nav class="hidden md:flex gap-6">
        <a href="#" class="text-gray-700 hover:text-indigo-500 font-medium">Inicio</a>
        <a href="#features" class="text-gray-700 hover:text-indigo-500 font-medium">Precios</a>
        <a href="#contacto" class="text-gray-700 hover:text-indigo-500 font-medium">Contacto</a>
      </nav>

      <div class="flex items-center gap-4">
        <!-- Botón Solicitar demo -->
        <a href="#" class="hidden md:inline-block px-5 py-2 bg-[#5fab92] text-white rounded-lg font-semibold hover:bg-[#3c8574]">Solicitar demo</a>

        <!-- Ícono Gatito -->
        <a href="/admin" title="Panel de administración" class="hidden md:inline-block text-gray-500 hover:text-[#3c8574] transition">
          <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0196 14.9374C11.7284 14.9374 11.4307 14.9818 11.1784 15.0796C11.0546 15.1275 10.9032 15.2031 10.7699 15.3252C10.6361 15.4479 10.4632 15.6749 10.4632 15.9999C10.4632 16.3249 10.6361 16.5519 10.7699 16.6745C10.9032 16.7967 11.0546 16.8722 11.1784 16.9202C11.4307 17.018 11.7284 17.0624 12.0196 17.0624C12.3109 17.0624 12.6085 17.018 12.8609 16.9202C12.9846 16.8722 13.136 16.7967 13.2693 16.6745C13.4032 16.5519 13.5761 16.3249 13.5761 15.9999C13.5761 15.6749 13.4032 15.4479 13.2693 15.3252C13.136 15.2031 12.9846 15.1275 12.8609 15.0796C12.6085 14.9818 12.3109 14.9374 12.0196 14.9374Z" />
            <path d="M14.0365 12.6464C14.2015 12.38 14.5274 12.0625 15.0163 12.0625C15.5051 12.0625 15.831 12.38 15.996 12.6464C16.1681 12.9243 16.2501 13.2612 16.2501 13.5938C16.2501 13.9263 16.1681 14.2632 15.996 14.5411C15.831 14.8075 15.5051 15.125 15.0163 15.125C14.5274 15.125 14.2015 14.8075 14.0365 14.5411C13.8644 14.2632 13.7824 13.9263 13.7824 13.5938C13.7824 13.2612 13.8644 12.9243 14.0365 12.6464Z" fill="#1C274C"></path> <path d="M9.01634 12.0625C8.52751 12.0625 8.20161 12.38 8.03658 12.6464C7.86445 12.9243 7.78247 13.2612 7.78247 13.5938C7.78247 13.9263 7.86445 14.2632 8.03658 14.5411C8.20161 14.8075 8.52751 15.125 9.01634 15.125C9.50518 15.125 9.83108 14.8075 9.9961 14.5411C10.1682 14.2632 10.2502 13.9263 10.2502 13.5938C10.2502 13.2612 10.1682 12.9243 9.9961 12.6464C9.83108 12.38 9.50518 12.0625 9.01634 12.0625Z" fill="#1C274C"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M6.09485 4.25C5.48148 4.25 4.77463 4.42871 4.20882 4.91616C3.62226 5.4215 3.27004 6.18781 3.27004 7.1875V9.0625L3.27005 9.06545C3.2712 9.35941 3.3211 9.94757 3.4888 10.4392C3.54365 10.6001 3.63129 10.8134 3.77764 11.0058C3.49364 11.5688 3.35904 12.1495 3.29787 12.7095C3.2468 13.1771 3.24611 13.6679 3.25424 14.1211C2.5932 14.3507 1.90877 14.6349 1.5932 14.8387C1.24524 15.0634 1.14534 15.5277 1.37006 15.8756C1.59478 16.2236 2.05903 16.3235 2.40698 16.0988C2.5234 16.0236 2.86686 15.8664 3.31867 15.6939C3.38755 16.173 3.52716 16.6095 3.7221 17.0063C3.56621 17.1035 3.42847 17.1935 3.31889 17.2652C3.27694 17.2926 3.23912 17.3173 3.20599 17.3387C2.85803 17.5634 2.75813 18.0277 2.98285 18.3756C3.20757 18.7236 3.67182 18.8235 4.01978 18.5988C4.0609 18.5722 4.10473 18.5436 4.15098 18.5134C4.28216 18.4278 4.43287 18.3294 4.59701 18.2288C5.18653 18.8313 5.91865 19.2964 6.67916 19.6462C8.45998 20.4654 10.569 20.75 12.0001 20.75C13.4311 20.75 15.5402 20.4654 17.321 19.6462C18.0815 19.2964 18.8136 18.8313 19.4031 18.2288C19.5673 18.3294 19.718 18.4278 19.8491 18.5134C19.8954 18.5436 19.9392 18.5722 19.9803 18.5988C20.3283 18.8235 20.7925 18.7236 21.0173 18.3756C21.242 18.0277 21.1421 17.5634 20.7941 17.3387C20.761 17.3173 20.7232 17.2926 20.6812 17.2652C20.5716 17.1935 20.4339 17.1035 20.2781 17.0063C20.473 16.6095 20.6127 16.173 20.6815 15.6938C21.1335 15.8663 21.4771 16.0236 21.5936 16.0988C21.9415 16.3235 22.4058 16.2236 22.6305 15.8756C22.8552 15.5277 22.7553 15.0634 22.4074 14.8387C22.0917 14.6349 21.4071 14.3506 20.7459 14.121C20.7541 13.6678 20.7534 13.177 20.7023 12.7095C20.6412 12.1495 20.5065 11.5688 20.2225 11.0058C20.3689 10.8134 20.4565 10.6001 20.5114 10.4392C20.6791 9.94758 20.729 9.35941 20.7301 9.06545L20.7302 9.0625V7.18761C20.7302 6.18792 20.3779 5.42162 19.7914 4.91628C19.2256 4.42882 18.5187 4.25011 17.9054 4.25011C17.4969 4.25011 17.0744 4.40685 16.7337 4.56076C16.3726 4.72392 15.9952 4.9359 15.6558 5.13136C15.5828 5.17339 15.5119 5.21444 15.443 5.25432L15.441 5.25548C15.177 5.4084 14.9427 5.5441 14.7339 5.65167C14.6042 5.7185 14.5035 5.7643 14.4285 5.79206C14.3969 5.80377 14.3767 5.80966 14.3663 5.81242C14.1129 5.81102 13.9514 5.79033 13.7181 5.76044C13.6681 5.75403 13.6147 5.74719 13.5564 5.74003C13.2098 5.69743 12.7722 5.65636 12.0001 5.65636C11.228 5.65636 10.7905 5.69743 10.4438 5.74003C10.3855 5.74719 10.3322 5.75403 10.2821 5.76044C10.0489 5.79033 9.88738 5.81102 9.63388 5.81242C9.62352 5.80966 9.60332 5.80376 9.57174 5.79206C9.49678 5.7643 9.39604 5.71849 9.26633 5.65166C9.05755 5.54408 8.82331 5.40842 8.55926 5.25548C8.48975 5.21523 8.41818 5.17377 8.34446 5.13132C8.00502 4.93584 7.62764 4.72384 7.26652 4.56067C6.92587 4.40675 6.50329 4.25 6.09485 4.25ZM6.16192 17.6138C6.49595 17.8657 6.8808 18.0879 7.30604 18.2835C8.83694 18.9877 10.7179 19.25 12.0001 19.25C13.2823 19.25 15.1632 18.9877 16.6941 18.2835C17.1194 18.0879 17.5042 17.8657 17.8382 17.6138C17.4858 17.5524 17.2179 17.245 17.2179 16.875C17.2179 16.4608 17.5537 16.125 17.9679 16.125C18.2951 16.125 18.6295 16.2068 18.9399 16.3204C19.0985 15.9885 19.1959 15.625 19.2226 15.2271C18.9249 15.1544 18.7193 15.125 18.6134 15.125C18.1992 15.125 17.8634 14.7892 17.8634 14.375C17.8634 13.9608 18.1992 13.625 18.6134 13.625C18.8081 13.625 19.0284 13.6542 19.2504 13.6974C19.2505 13.4213 19.2415 13.1502 19.2112 12.8724C19.1407 12.227 18.958 11.6541 18.5269 11.1447C18.3727 10.9625 18.1809 10.7813 17.9402 10.6045C17.6063 10.3594 17.5344 9.88999 17.7796 9.55611C18.0247 9.22224 18.4941 9.15031 18.828 9.39546C18.9471 9.48292 19.0597 9.57282 19.1659 9.66506C19.2099 9.43686 19.2295 9.19817 19.2302 9.06087V7.18761C19.2302 6.56231 19.0238 6.23486 18.8123 6.0527C18.5801 5.85266 18.2496 5.75011 17.9054 5.75011C17.835 5.75011 17.659 5.78868 17.3513 5.92771C17.064 6.0575 16.7432 6.23612 16.4043 6.43125C16.3407 6.4679 16.2759 6.50544 16.2106 6.54328C15.9428 6.69843 15.666 6.85883 15.4209 6.98509C15.2663 7.06473 15.1052 7.14099 14.9495 7.19867C14.8058 7.25192 14.607 7.3125 14.3941 7.3125C14.0223 7.3125 13.7617 7.27877 13.5115 7.2464C13.4654 7.24043 13.4196 7.23449 13.3735 7.22883C13.0848 7.19336 12.7084 7.15636 12.0001 7.15636C11.2919 7.15636 10.9154 7.19336 10.6267 7.22883C10.5807 7.23449 10.5349 7.24042 10.4887 7.24639C10.2386 7.27877 9.97796 7.3125 9.6061 7.3125C9.39326 7.3125 9.19445 7.25191 9.05069 7.19866C8.89497 7.14098 8.73386 7.06471 8.57928 6.98506C8.33423 6.8588 8.05742 6.69839 7.78968 6.54325C7.72435 6.50539 7.65955 6.46784 7.59589 6.43118C7.25702 6.23603 6.93614 6.05741 6.64888 5.92761C6.34115 5.78856 6.16522 5.75 6.09485 5.75C5.75062 5.75 5.42007 5.85254 5.18787 6.05259C4.97643 6.23475 4.77004 6.56219 4.77004 7.1875V9.06088C4.7707 9.19819 4.79025 9.43686 4.83425 9.66506C4.94053 9.57281 5.05309 9.48292 5.1722 9.39546C5.50608 9.15031 5.97547 9.22224 6.22062 9.55612C6.46577 9.88999 6.39385 10.3594 6.05997 10.6045C5.81926 10.7813 5.62748 10.9625 5.47331 11.1447C5.04223 11.6541 4.85949 12.227 4.789 12.8724C4.75865 13.1502 4.74966 13.4213 4.74975 13.6975C4.97192 13.6543 5.19231 13.625 5.38719 13.625C5.80141 13.625 6.13719 13.9608 6.13719 14.375C6.13719 14.7892 5.80141 15.125 5.38719 15.125C5.28121 15.125 5.07549 15.1544 4.77758 15.2271C4.80434 15.625 4.90168 15.9885 5.06027 16.3203C5.37069 16.2068 5.70504 16.125 6.03224 16.125C6.44646 16.125 6.78224 16.4608 6.78224 16.875C6.78224 17.245 6.51433 17.5524 6.16192 17.6138Z" fill="#1C274C"></path> </g></svg>
            <!-- Puedes incluir aquí el resto del contenido SVG completo si quieres mantener cada detalle -->
          </svg>
        </a>

      </div>
    </div>
  </header>


  <!-- Hero -->
  <section class="bg-yellow-50 py-20">
    <div class="max-w-5xl mx-auto px-4 text-center">
      <img src="/images/logo1.png" alt="Logo VetCodex" class="mx-auto mb-6 w-80">
      <h1 class="text-5xl font-bold mb-4">Bienvenido a VetCodex</h1>
      <p class="text-lg text-gray-700 mb-8">La plataforma multicliente más completa para clínicas veterinarias.</p>
      <!-- Botones del Hero -->
      <div class="flex justify-center gap-4">
        <a href="#" class="px-6 py-3 bg-[#5fab92] text-white rounded-lg hover:bg-[#3c8574] transition">Comenzar ahora</a>
        <a href="#features" class="px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100">Conocer más</a>
      </div>

    </div>
  </section>

  <!-- Features -->
  <section id="features" class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <!-- Texto superior -->
      <div class="mb-10 md:mb-16">
        <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Características destacadas</h2>
        <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">VetCodex integra todo lo necesario para que las clínicas veterinarias gestionen sus operaciones con eficiencia y profesionalismo.</p>
      </div>

      <!-- Grid de características -->
      <div class="grid gap-12 sm:grid-cols-2 xl:grid-cols-3 xl:gap-16">
        <!-- Gestión de mascotas -->
        <div class="flex flex-col items-center">
          <div class="mb-4 flex h-14 w-14 items-center justify-center text-[#95c7a4]">
            <svg class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <h3 class="mb-2 text-center text-lg font-semibold md:text-xl">Gestión de Mascotas</h3>
          <p class="mb-2 text-center text-gray-500">Historiales clínicos, vacunas y tratamientos siempre disponibles.</p>
        </div>

        <!-- Agenda inteligente -->
        <div class="flex flex-col items-center">
          <div class="mb-4 flex h-14 w-14 items-center justify-center text-[#95c7a4]">
            <svg class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
          </div>
          <h3 class="mb-2 text-center text-lg font-semibold md:text-xl">Agenda Inteligente</h3>
          <p class="mb-2 text-center text-gray-500">Reserva de citas organizada por veterinario y servicios.</p>
        </div>

        <!-- Facturación -->
        <div class="flex flex-col items-center">
          <div class="mb-4 flex h-14 w-14 items-center justify-center text-[#95c7a4]">
            <svg class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v2m14 0V9m0 0v6a2 2 0 01-2 2H5a2 2 0 01-2-2V9h14z" />
            </svg>
          </div>
          <h3 class="mb-2 text-center text-lg font-semibold md:text-xl">Facturación Rápida</h3>
          <p class="mb-2 text-center text-gray-500">Cobros simples y automatizados para servicios y productos.</p>
        </div>

        <!-- Inventario -->
        <div class="flex flex-col items-center">
          <div class="mb-4 flex h-14 w-14 items-center justify-center text-[#95c7a4]">
            <svg class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3V3zm4 8h10v2H7v-2z" />
            </svg>
          </div>
          <h3 class="mb-2 text-center text-lg font-semibold md:text-xl">Inventario Controlado</h3>
          <p class="mb-2 text-center text-gray-500">Control detallado de stock y alertas de abastecimiento.</p>
        </div>

        <!-- Gestión de usuarios -->
        <div class="flex flex-col items-center">
          <div class="mb-4 flex h-14 w-14 items-center justify-center text-[#95c7a4]">
            <svg class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A7 7 0 0112 15a7 7 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </div>
          <h3 class="mb-2 text-center text-lg font-semibold md:text-xl">Gestión de Usuarios</h3>
          <p class="mb-2 text-center text-gray-500">Control de accesos y roles según tipo de usuario (admin, vet, cliente).</p>
        </div>

        <!-- Reportes automáticos -->
        <div class="flex flex-col items-center">
          <div class="mb-4 flex h-14 w-14 items-center justify-center text-[#95c7a4]">
            <svg class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-4-4H4m16 0h-1a4 4 0 00-4 4v2M12 3v4m0 0l2-2m-2 2l-2-2" />
            </svg>
          </div>
          <h3 class="mb-2 text-center text-lg font-semibold md:text-xl">Reportes Automáticos</h3>
          <p class="mb-2 text-center text-gray-500">Genera informes mensuales de atención, ventas y más con un clic.</p>
        </div>
      </div>
    </div>
  </section>


  <!-- Footer -->
  <div class="bg-white pt-4 sm:pt-10 lg:pt-12">
    <footer class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <div class="flex flex-col items-center border-t pt-6">
        <!-- nav - start -->
        <nav class="mb-4 flex flex-wrap justify-center gap-x-4 gap-y-2 md:justify-start md:gap-6">
          <a href="#" class="text-gray-500 transition duration-100 hover:text-[#95c7a4]">Inicio</a>
          <a href="#" class="text-gray-500 transition duration-100 hover:text-[#95c7a4]">Clínicas</a>
          <a href="#" class="text-gray-500 transition duration-100 hover:text-[#95c7a4]">Blog</a>
          <a href="#" class="text-gray-500 transition duration-100 hover:text-[#95c7a4]">Contacto</a>
          <a href="#" class="text-gray-500 transition duration-100 hover:text-[#95c7a4]">Políticas</a>
        </nav>
        <!-- nav - end -->

        <!-- social - start -->
        <div class="flex gap-6 mt-2 items-center justify-center">
          <!-- WhatsApp -->
          <a href="https://wa.me/56932365067" target="_blank" class="flex flex-col items-center text-gray-400 hover:text-[#95c7a4] transition">
            <svg class="h-6 w-6 mb-1" fill="currentColor" viewBox="0 0 32 32">
              <path d="M16.004 3C9.384 3 4 8.385 4 15.002c0 2.646.863 5.096 2.322 7.1L4.59 28.59l6.645-1.734A12.914 12.914 0 0016.003 27c6.618 0 11.998-5.384 11.998-11.998C28.002 8.385 22.62 3 16.004 3zm6.498 16.829c-.28.787-1.622 1.52-2.24 1.613-.604.09-1.356.127-2.188-.137a18.23 18.23 0 01-1.91-.761c-3.333-1.45-5.518-4.64-5.69-4.86-.173-.223-1.36-1.812-1.36-3.464s.86-2.462 1.164-2.795c.303-.334.66-.418.88-.418.224 0 .44.002.63.012.202.01.47-.075.734.56.28.666.953 2.307 1.037 2.475.086.17.144.375.026.598-.118.223-.176.362-.343.56-.17.202-.36.45-.514.602-.17.172-.348.36-.15.704.2.344.888 1.457 1.91 2.363 1.313 1.17 2.42 1.54 2.764 1.712.342.17.54.15.743-.086.204-.235.866-1.01 1.097-1.36.224-.35.454-.29.765-.173.31.118 1.955.92 2.29 1.086.33.168.55.246.63.38.078.136.078.788-.202 1.576z" />
            </svg>
            <span class="text-xs">Contáctanos</span>
          </a>

          <!-- Gmail -->
          <a href="mailto:soporte.vetcodex@gmail.com" class="flex flex-col items-center text-gray-400 hover:text-[#95c7a4] transition">
            <svg class="h-6 w-6 mb-1" viewBox="0 0 24 24" fill="currentColor">
              <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 2l-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z" />
            </svg>
            <span class="text-xs">Escríbenos</span>
          </a>

          <!-- GitHub o Repositorio -->
          <a href="https://github.com/DanaeGonzalez/Equipo_4_TIS-2" target="_blank" class="flex flex-col items-center text-gray-400 hover:text-[#95c7a4] transition">
            <svg class="h-6 w-6 mb-1" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 .5C5.648.5.5 5.648.5 12c0 5.086 3.292 9.396 7.86 10.93.574.106.79-.25.79-.558 0-.274-.01-1.003-.016-1.97-3.2.694-3.875-1.543-3.875-1.543-.523-1.328-1.278-1.682-1.278-1.682-1.046-.716.08-.702.08-.702 1.156.08 1.763 1.187 1.763 1.187 1.03 1.76 2.7 1.252 3.356.96.105-.746.403-1.252.732-1.54-2.553-.29-5.238-1.277-5.238-5.682 0-1.255.448-2.282 1.184-3.086-.12-.29-.512-1.457.112-3.037 0 0 .965-.31 3.16 1.18.918-.255 1.902-.382 2.88-.386.978.004 1.962.13 2.88.386 2.192-1.49 3.154-1.18 3.154-1.18.628 1.58.236 2.747.116 3.037.74.804 1.18 1.83 1.18 3.086 0 4.415-2.69 5.387-5.25 5.672.41.356.778 1.064.778 2.145 0 1.55-.014 2.8-.014 3.18 0 .31.214.67.794.558A10.51 10.51 0 0023.5 12c0-6.352-5.148-11.5-11.5-11.5z" />
            </svg>
            <span class="text-xs">Ver código</span>
          </a>
        </div>
        <!-- social - end -->
      </div>

      <div class="py-8 text-center text-sm text-gray-400">© 2025 VetCodex. Todos los derechos reservados.</div>
    </footer>
  </div>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>