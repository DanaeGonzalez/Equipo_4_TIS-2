<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php')); // Rutas centrales

            Route::middleware([
                'web',
                \Stancl\Tenancy\Middleware\InitializeTenancyByDomain::class,
                \Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains::class,
            ])
                ->group(base_path('routes/tenant.php'));

            Route::middleware('web')
                ->group(base_path('routes/schedules.php'));

            Route::middleware('web')
                ->group(base_path('routes/appointments.php'));

            /* Route::middleware('web')
                ->group(base_path('routes/billing.php'));
    
            Route::middleware('web')
                ->group(base_path('routes/clinical_records.php'));
    
            Route::middleware('web')
                ->group(base_path('routes/blog.php'));
    
            Route::middleware('web')
                ->group(base_path('routes/services.php'));
    
            Route::middleware('web')
                ->group(base_path('routes/settings.php'));
            
            Route::middleware('web')
                ->group(base_path('routes/notes.php'));*/
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
