<?php

namespace App\Filament\Pages;

use AllowDynamicProperties;
use App\Enums\Rol;
use App\Models\Incidencia;
use Filament\Pages\Page;

class Documentaciones extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static string $view = 'filament.pages.documentaciones';

    protected static ?int $navigationSort = 101;
    protected static ?string $navigationLabel = 'Documentación Proyectos';

    public static function canAccess(): bool
    {
        return getUserRol() === Rol::Admin;
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Documentación');
    }

    public function mount()
    {
        $this->incidencias = Incidencia::latest()->get();
    }

    public function getViewData(): array
    {
        return [
            'incidencias' => Incidencia::latest()->get(),
        ];
    }
}
