<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CSRF Test</title>
</head>
<body>
    <h1>Test CSRF</h1>

    <form method="POST" action="{{ route('csrf.test') }}">
        @csrf
        <button type="submit">Enviar prueba</button>
    </form>
</body>
</html>
