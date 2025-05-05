<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Superadmin</title>
</head>
<body>
    <h1>Login Superadmin</h1>

    @if($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('superadmin.login.post') }}">
        @csrf

        <div>
            <label>Email:</label>
            <input type="email" name="email" required autofocus>
        </div>

        <div>
            <label>Contraseña:</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>
                <input type="checkbox" name="remember">
                Recordarme
            </label>
        </div>

        <button type="submit">Ingresar</button>
    </form>
</body>
</html>
