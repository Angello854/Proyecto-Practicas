<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Filament\Facades\Filament;
use Filament\Panel;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use TomatoPHP\FilamentIssues\Facades\FilamentIssues;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //46554
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentIssues::register([
            'tomatophp/filament-issues',
            'tomatophp/filament-cms',
            'tomatophp/filament-pms',
        ]);
    }
}
