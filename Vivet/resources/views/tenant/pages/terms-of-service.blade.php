{{-- resources/views/pages/terms-of-service.blade.php --}}
@extends('tenant.layouts.app')

@section('title', 'Términos de Servicio - Clínica Veterinaria')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16 text-gray-800">
    <h1 class="text-3xl font-bold mb-6 text-[var(--color-title)]">Términos de Servicio</h1>

    <p class="mb-4">
        Bienvenido a Clínica Veterinaria Vivet. Al utilizar nuestro sitio web y nuestros servicios, aceptas los siguientes términos y condiciones. Te recomendamos leerlos detenidamente.
    </p>

    <h2 class="text-xl font-semibold mt-8 mb-2">1. Uso del sitio</h2>
    <p class="mb-4">
        Este sitio está destinado a proporcionar información general sobre nuestros servicios veterinarios. El uso indebido del contenido o de los servicios será motivo de restricción o suspensión.
    </p>

    <h2 class="text-xl font-semibold mt-8 mb-2">2. Citas y servicios</h2>
    <p class="mb-4">
        Al agendar una cita, aceptas proporcionar información veraz. Nos reservamos el derecho de reprogramar o cancelar citas si no se cumplen nuestras condiciones.
    </p>

    <h2 class="text-xl font-semibold mt-8 mb-2">3. Propiedad intelectual</h2>
    <p class="mb-4">
        Todo el contenido de este sitio (textos, imágenes, logotipos) pertenece a Clínica Vivet y no puede ser reutilizado sin autorización previa.
    </p>

    <h2 class="text-xl font-semibold mt-8 mb-2">4. Cambios en los términos</h2>
    <p class="mb-4">
        Nos reservamos el derecho de modificar estos términos en cualquier momento. Los cambios serán publicados en esta misma sección.
    </p>

    <p class="mt-8 text-sm text-gray-500">
        Última actualización: {{ date('d/m/Y') }}
    </p>
</div>
@endsection
