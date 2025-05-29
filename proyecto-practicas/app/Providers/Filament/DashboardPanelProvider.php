<?php

namespace App\Providers\Filament;

use App\Enums\Rol;
use App\Filament\Pages\DocumentacionAlumno;
use App\Filament\Pages\DocumentacionTutorDocente;
use App\Filament\Pages\DocumentacionTutorLaboral;
use Exception;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
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
use Illuminate\Validation\Rules\Password;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Jeffgreco13\FilamentBreezy\Middleware\MustTwoFactor;
use App\Filament\Pages\Documentacion;

class DashboardPanelProvider extends PanelProvider
{
    /**
     * @throws Exception
     */
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('dashboard')
            ->path('dashboard')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
                Documentacion::class,
                DocumentacionAlumno::class,
                DocumentacionTutorDocente::class,
                DocumentacionTutorLaboral::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
            ])
            ->plugins([
                BreezyCore::make()
                ->myProfile(
                shouldRegisterNavigation: true, // Customizes the 'account' link label in the panel User Menu (default = null)
                hasAvatars: true, // Sets the navigation group for the My Profile page (default = null)
                navigationGroup: 'Configuración', // Enables the avatar upload form component (default = false)
                userMenuLabel: 'My Profile' // Sets the slug for the profile page (default = 'my-profile')
                )
                ->avatarUploadComponent(fn($fileUpload) => $fileUpload->disableLabel())
                ->enableTwoFactorAuthentication(
                force: false,
                authMiddleware: MustTwoFactor::class
                ),
            ])
            ->resources([
                config('filament-logger.activity_resource'),
            ])
            ->renderHook(
                'body.end',
                fn (): string => view('components.whitecube-cookie-wrapper')->render()
            )
            ->navigationItems([
                // Ítem para alumnos


                // GitHub
                NavigationItem::make('Ver en GitHub')
                    ->url('https://github.com/' . config('github.repository.owner') . '/' . config('github.repository.name'))
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->openUrlInNewTab()
                    ->group('GitHub')
                    ->sort(12)
                    ->visible(fn () => auth()->check() && getUserRol() === Rol::Admin),
            ]);
    }
}
