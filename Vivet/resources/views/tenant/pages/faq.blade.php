@extends('layouts.app')

@section('title', 'Preguntas Frecuentes')

@section('content')
<section class="py-24 px-6 bg-[var(--color-bg-main)] text-[var(--color-text)]">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-center mb-10 text-[var(--color-title)]">Preguntas Frecuentes</h1>

        <div class="space-y-6">
            <div class="border-b pb-4">
                <h2 class="text-xl font-semibold">¿Necesito agendar una cita previa?</h2>
                <p class="mt-2 text-base">
                    Sí, te recomendamos agendar tu cita con anticipación para asegurar disponibilidad y atención oportuna.
                </p>
            </div>

            <div class="border-b pb-4">
                <h2 class="text-xl font-semibold">¿Atienden emergencias?</h2>
                <p class="mt-2 text-base">
                    Sí, contamos con atención de urgencia. Puedes llamarnos directamente para coordinar.
                </p>
            </div>

            <div class="border-b pb-4">
                <h2 class="text-xl font-semibold">¿Qué servicios ofrecen?</h2>
                <p class="mt-2 text-base">
                    Ofrecemos consultas, cirugías, vacunación, peluquería, laboratorio, esterilización y más.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
