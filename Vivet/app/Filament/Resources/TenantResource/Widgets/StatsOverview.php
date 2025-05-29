<?php

namespace App\Filament\Resources\TenantResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Tenant;
use Illuminate\Support\Carbon;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total de clínicas', Tenant::count())
                ->description('Registradas en el sistema')
                ->color('success'),

            Stat::make('Creadas hoy', Tenant::whereDate('created_at', now())->count())
                ->description('En las últimas 24 horas')
                ->color('warning'),
            Stat::make('Creadas este mes', Tenant::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count())
                ->description('En el mes actual')
                ->color('info'),
            Stat::make('Creadas esta semana', Tenant::whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek(),
            ])->count())
                ->description('Desde el lunes')
                ->color('info'),


        ];
    }
}
