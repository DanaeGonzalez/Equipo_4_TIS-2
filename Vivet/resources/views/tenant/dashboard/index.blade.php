@extends('tenant.layouts.admin')

@section('title', 'Panel de Administración')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <div class="col-span-12 space-y-6 xl:col-span-7">
            {{-- Métricas --}}
            @include('tenant.partials.admin.metric-group.metric-group-01')

            {{-- Gráfico 1 --}}
            @include('tenant.partials.admin.chart.chart-01')
        </div>

        <div class="col-span-12 xl:col-span-5">
            {{-- Gráfico 2 --}}
            @include('tenant.partials.admin.chart.chart-02')
        </div>

        <div class="col-span-12">
            {{-- Gráfico 3 --}}
            @include('tenant.partials.admin.chart.chart-03')
        </div>

        <div class="col-span-12 xl:col-span-5">
            {{-- Mapa (opcional) --}}
            @include('tenant.partials.admin.map-01')
        </div>

        <div class="col-span-12 xl:col-span-7">
            {{-- Tabla (opcional) --}}
            @include('tenant.partials.admin.table.table-01')
        </div>
    </div>
</div>
@endsection
