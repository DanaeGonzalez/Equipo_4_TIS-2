<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Resources\TenantResource\Widgets\StatsOverview;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        //dd('Panel loaded'); // 👈 esto detendrá la app si se ejecuta

        return $panel
            ->brandName('VetCodex')
            //->brandLogo(fn() => asset('images/logo.png'))
            //->favicon(asset('images/favicon.ico'))
            ->default()
            ->id('admin')
            ->path('admin')
            ->domain(env('CENTRAL_DOMAIN', 'vetcodex.test'))
            ->login()
            ->colors([
                'primary' => '#5fab92',
                'danger' => '#e3342f',
                'success' => '#38c172',
                'warning' => '#f6993f',
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->resources([ // 👈 REGISTRA EXPLÍCITAMENTE EL CRUD
                \App\Filament\Resources\TenantResource::class,
            ])
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                StatsOverview::class,
                //Widgets\BienvenidaWidget::class,
                //Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    /*public function canAccessPanel(Request $request): bool
    {
        return true;
    }*/
}
