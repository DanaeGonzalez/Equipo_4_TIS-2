<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Superadmin Dashboard</title>
</head>
<body>
    <h1>Bienvenido al Panel de Superadministrador</h1>

    <p>¡Aquí vas a gestionar todas las clínicas y configuraciones del sistema!</p>

    <form action="{{ route('superadmin.logout') }}" method="POST">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
</body>
</html>
