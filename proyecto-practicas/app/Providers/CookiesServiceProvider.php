<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Blade;
use Whitecube\LaravelCookieConsent\Consent;
use Whitecube\LaravelCookieConsent\CookiesServiceProvider as ServiceProvider;
use Whitecube\LaravelCookieConsent\Facades\Cookies;

class CookiesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        parent::register();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        parent::boot();

        // Registrar las vistas de Whitecube en Filament
        if (class_exists(FilamentView::class)) {
            FilamentView::registerRenderHook(
                'body.end',
                fn (): string => view('components.whitecube-cookie-wrapper')->render()
            );

            // Para el panel de administración específicamente
            FilamentView::registerRenderHook(
                'panels::body.end',
                fn (): string => view('components.whitecube-cookie-wrapper')->render()
            );
        }
    }

    /**
     * Define the cookies users should be aware of.
     */
    protected function registerCookies(): void
    {
        // Register Laravel's base cookies under the "required" cookies section:
        Cookies::essentials()
            ->session()
            ->csrf();

        // Register all Analytics cookies at once using one single shorthand method:
        Cookies::analytics()
            ->google(
                id: config('cookieconsent.google_analytics.id'),
                anonymizeIp: config('cookieconsent.google_analytics.anonymize_ip')
            );

        // Register custom cookies under the pre-existing "optional" category:
        Cookies::optional()
            ->name('darkmode_enabled')
            ->description('This cookie helps us remember your preferences regarding the interface\'s brightness.')
            ->duration(120)
            ->accepted(fn(Consent $consent, $darkmode = null) => $consent->cookie(value: $darkmode ? $darkmode->getDefaultValue() : false));
    }
}
