@extends('tenant.layouts.dashboard')

@section('title', 'Pacientes')

@section('content')

<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">

        <div class="flex flex-col lg:flex-row items-start md:items-center justify-between gap-2 mb-4">
            {{-- Título a la izquierda --}}
            <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
                Tabla de Ejemplo
            </h1>

            {{-- Breadcrumb a la derecha --}}
            @include('tenant.partials.dashboard.breadcrumbs', [
            'items' => [
            ['name' => 'Ayuda', 'url' => '#'],
            ['name' => 'Ejemplo'],
            ]
            ])
        </div>
        
        <x-dashboard.table :headers="$columns" :rows="$rows" :pagination="$pagination" />

    </div>
</section>
@endsection