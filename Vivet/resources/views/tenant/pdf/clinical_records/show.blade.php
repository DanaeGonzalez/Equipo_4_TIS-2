@extends('tenant.pdf.layouts.base')

@section('title', 'Ficha Clínica')
@section('header-title', 'Ficha Clínica')

@section('content')

<h3>Mascota</h3>
<table>
    <tr><td class="label">Nombre:</td><td>{{ $clinicalRecord->pet->pet_name }}</td></tr>
    <tr><td class="label">Especie:</td><td>{{ $clinicalRecord->pet->species }}</td></tr>
    <tr><td class="label">Raza:</td><td>{{ $clinicalRecord->pet->breed }}</td></tr>
    <tr><td class="label">Sexo:</td><td>{{ $clinicalRecord->pet->sex }}</td></tr>
    <tr><td class="label">Color:</td><td>{{ $clinicalRecord->pet->color }}</td></tr>
    <tr><td class="label">Fecha nacimiento:</td><td>{{ $clinicalRecord->pet->date_of_birth ?? '-' }}</td></tr>
</table>

<h3>Propietario</h3>
<table>
    <tr><td class="label">Nombre:</td><td>{{ $clinicalRecord->pet->client->name }} {{ $clinicalRecord->pet->client->lastname }}</td></tr>
    <tr><td class="label">Email:</td><td>{{ $clinicalRecord->pet->client->email }}</td></tr>
    <tr><td class="label">Teléfono:</td><td>{{ $clinicalRecord->pet->client->phone ?? '-' }}</td></tr>
    <tr><td class="label">Dirección:</td><td>{{ $clinicalRecord->pet->client->address ?? '-' }}</td></tr>
</table>

<h3>Información Clínica</h3>
<table>
    <tr><td class="label">Fecha de atención:</td><td>{{ $clinicalRecord->date->format('d/m/Y H:i') }}</td></tr>
    <tr><td class="label">Veterinario:</td><td>{{ $clinicalRecord->vet->name }} {{ $clinicalRecord->vet->lastname }}</td></tr>
    <tr><td class="label">Peso:</td><td>{{ $clinicalRecord->weight ? $clinicalRecord->weight . ' kg' : '-' }}</td></tr>
    <tr><td class="label">Temperatura:</td><td>{{ $clinicalRecord->temperature ? $clinicalRecord->temperature . ' °C' : '-' }}</td></tr>
</table>

<h3>Síntomas</h3>
<p>{{ $clinicalRecord->symptoms ?: '-' }}</p>

@if($clinicalRecord->diagnosis)
    <h3>Diagnóstico</h3>
    <p>{{ $clinicalRecord->diagnosis }}</p>
@endif

@if($clinicalRecord->treatment)
    <h3>Tratamiento</h3>
    <p>{{ $clinicalRecord->treatment }}</p>
@endif

@if($clinicalRecord->notes)
    <h3>Notas Adicionales</h3>
    <p>{{ $clinicalRecord->notes }}</p>
@endif

@endsection
