<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VetCodex</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"
      rel="stylesheet"
    />
  </head>
  <body class="bg-gray-100">

    <!-- Hero Section -->
    <section class="bg-white py-20" style="background-color: #FFFAEC;">
      <div class="max-w-7xl mx-auto px-4 text-center">
        <img src="/images/logo.png" alt="Logo de VetCodex" class="mx-auto mb-6 w-48 h-auto">
        <h1 class="text-4xl md:text-6xl font-bold text-gray-800 mb-6">Bienvenido a VetCodex</h1>
        <p class="text-lg text-gray-600 mb-8">Plataforma multicliente para clínicas veterinarias.</p>
        

        <!-- <div class="flex justify-center space-x-4">
          <a href="#demo" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Ver demo</a>
          <a href="#contacto" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">Contacto</a>
        </div> -->
      </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-100">
      <div class="max-w-6xl mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8 text-center">
          <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-2">Gestión de Mascotas</h3>
            <p class="text-gray-600">Registra historiales, vacunas y tratamientos fácilmente.</p>
          </div>
          <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-2">Agenda Inteligente</h3>
            <p class="text-gray-600">Organiza citas por veterinario, en el servicio que necesites.</p>
          </div>
          <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-2">Facturación Rápida</h3>
            <p class="text-gray-600">Emite facturas con un clic desde la misma plataforma.</p>
          </div>
          <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-2">Gestión de inventario</h3>
            <p class="text-gray-600">Registra entradas y salidas de insumos, para que tu clinica jamás esté desabastecida.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white py-6 border-t mt-12">
      <div class="text-center text-gray-600 text-sm">
        © {{ date('Y') }} VetCodex. Todos los derechos reservados.
      </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
  </body>
</html>
