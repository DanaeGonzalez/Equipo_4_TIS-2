<?php

namespace App\Providers;

use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Http\Request;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->domain('vetcodex.test') // 👈 solo permite este dominio
            ->login()
            ->colors([
                'primary' => '#4f46e5',
            ]);
    }

    public function canAccessPanel(Request $request): bool
    {
        return auth()->check() && auth()->user()->email === 'super@vetcodex.test';
    }
}
