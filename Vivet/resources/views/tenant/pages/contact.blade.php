@extends('tenant.layouts.app')

@section('title', 'Contacto - Clínica Veterinaria')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16 text-gray-800">
    <h1 class="text-3xl font-bold mb-6 text-[var(--color-title)]">Contáctanos</h1>

    <p class="mb-6 text-[var(--color-text)]">
        ¿Tienes preguntas, necesitas agendar una cita o quieres saber más sobre nuestros servicios?
        Completa el formulario y te responderemos lo antes posible.
    </p>

    <form action="#" method="POST" class="space-y-6">
        @csrf <!-- Si luego quieres que sea funcional con backend -->

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="name" id="name" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[var(--color-accent-2)] focus:ring-[var(--color-accent-2)]">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
            <input type="email" name="email" id="email" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[var(--color-accent-2)] focus:ring-[var(--color-accent-2)]">
        </div>

        <div>
            <label for="message" class="block text-sm font-medium text-gray-700">Mensaje</label>
            <textarea name="message" id="message" rows="4" required
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[var(--color-accent-2)] focus:ring-[var(--color-accent-2)]"></textarea>
        </div>

        <div>
            <button type="submit"
                    style="background-color: var(--color-button-secondary);"
                    class="px-6 py-2 text-white font-semibold rounded-md hover:opacity-90">
                Enviar mensaje
            </button>
        </div>
    </form>

    <div class="mt-12">
        <h2 class="text-xl font-semibold mb-2 text-[var(--color-title)]">Información de contacto</h2>
        <p class="text-[var(--color-text)]">📍 30 de octubre 660, Concepción, Chile</p>
        <p class="text-[var(--color-text)]">📞 +56 9 4251 3361</p>
        <p class="text-[var(--color-text)]">✉️ contacto@vivet.cl</p>
    </div>
</div>
@endsection
