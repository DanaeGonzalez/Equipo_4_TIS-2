@extends('tenant.pdf.layouts.base')

@section('title', 'Reporte de Citas')
@section('header-title', 'Reporte de Citas')

@section('content')
<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Mascota</th>
            <th>Propietario</th>
            <th>Veterinario</th>
            <th>Motivo</th>
            <!--<th>Estado</th>-->
        </tr>
    </thead>
    <tbody>
        @foreach($appointments as $appointment)
        <tr>
            <td>{{ $appointment->appointment_date->format('d/m/Y H:i') }}</td>
            <td>{{ $appointment->pet->pet_name }}</td>
            <td>{{ $appointment->pet->client->name }} {{ $appointment->pet->client->lastname }}</td>
            <td>{{ $appointment->vet->name }} {{ $appointment->vet->lastname }}</td>
            <td>{{ $appointment->reason }}</td>
            <!--<td>{{ $appointment->status }}</td>-->
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
