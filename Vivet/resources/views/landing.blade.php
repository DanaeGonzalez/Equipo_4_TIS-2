<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vivet - Clínica Veterinaria</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-blue-50 to-teal-100 min-h-screen flex flex-col justify-center items-center font-sans">

    <div class="bg-white shadow-2xl rounded-2xl p-8 max-w-lg w-full text-center">
        <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="Veterinaria" class="w-24 mx-auto mb-4">
        
        <h1 class="text-3xl font-extrabold text-blue-600">Bienvenido a Vivet</h1>
        <p class="text-gray-700 mt-2 mb-6">Cuidamos de tus mascotas con pasión y profesionalismo.</p>

        <a href="#" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-xl transition duration-300">
            Solicitar Turno
        </a>
    </div>

    <footer class="mt-10 text-sm text-gray-600">
        &copy; {{ date('Y') }} Vivet. Todos los derechos reservados.
    </footer>

</body>
</html>
