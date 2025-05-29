<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nuevo Examen Recibido</title>
</head>
<body>
    <p>Hola {{ $recipient->name }},</p>

    <p>Has recibido un nuevo examen de parte de <strong>{{ $sender->name }}</strong>.</p>

    <p>El archivo ha sido adjuntado a este correo.</p>

    <p>Gracias por confiar en nosotros!<br>Vivet</p>
</body>
</html>
