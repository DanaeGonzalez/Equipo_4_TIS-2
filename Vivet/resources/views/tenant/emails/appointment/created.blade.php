<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cita confirmada</title>
</head>
<body>
    <h2>Hola {{ $appointment->pet->client->name }} {{ $appointment->pet->client->lastname }}!</h2>
    <p>Tu cita ha sido registrada exitosamente con el siguiente detalle:</p>
    <ul>
        <li>Fecha: {{ \Carbon\Carbon::parse($appointment->schedule->event_date)->format('d-m-Y') }}</li>
        <li>Hora: {{ $appointment->schedule->event_time }}</li>
        <li>Mascota: {{ $appointment->pet_name }}</li>
        <li>Motivo: {{ $appointment->reason }}</li>
        <li>Veterinario: {{ $appointment->veterinarian->name }}</li>
    </ul>
    <p>Gracias por confiar en nosotros!<br>Vivet</p>
</body>
</html>