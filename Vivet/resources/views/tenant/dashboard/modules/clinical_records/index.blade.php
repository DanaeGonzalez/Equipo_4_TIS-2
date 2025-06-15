@extends('tenant.layouts.dashboard')

@section('title', 'Fichas Clínicas')

@section('content')

<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">

        <div class="flex flex-col lg:flex-row items-start md:items-center justify-between gap-2 mb-4">
            {{-- Título a la izquierda --}}
            <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
                Ver Todas las fichas clínicas
            </h1>

            {{-- Breadcrumb a la derecha --}}
            @include('tenant.partials.dashboard.breadcrumbs', [
            'items' => [
            ['name' => 'Gestion clínica', 'url' => '#'],
            ['name' => 'Fichas clínicas'],
            ]
            ])
        </div>

        <x-dashboard.table :headers="$columns" :rows="$rows" :pagination="$pagination" add-label="Crear nueva Ficha clínica" 
        add-url="{{ route('clinical_records.create') }}" />

    </div>
</section>
@endsection