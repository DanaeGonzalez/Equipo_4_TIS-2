@extends('tenant.layouts.app')

@section('title', 'Blog - Clínica Veterinaria')

@section('content')
<section class="min-h-[50vh] flex items-center justify-center bg-[var(--color-bg-main)] px-4 py-24">
    <div class="text-center max-w-xl">
        <h1 class="text-3xl md:text-4xl font-bold text-[var(--color-title)] mb-4">Nuestro Blog</h1>
        <p class="text-lg text-[var(--color-text)]">
            Próximamente encontrarás aquí artículos, consejos y novedades sobre el cuidado de tus mascotas.
        </p>
    </div>
</section>
@endsection
