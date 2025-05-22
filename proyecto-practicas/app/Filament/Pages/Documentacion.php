<?php

namespace App\Filament\Pages;

use App\Enums\Rol;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Page;

class Documentacion extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.documentacion';

    // Establecer un orden alto para que aparezca al final
    protected static ?int $navigationSort = 100;

    // Establecer etiqueta de navegación
    protected static ?string $navigationLabel = 'Índice';

    public function mount(): void
    {
        // Redireccionar a la ruta de documentación
        redirect()->route('documentacion.index');
    }

    public static function canAccess(): bool
    {
        return getUserRol() === Rol::Admin;
    }

    // Configuración del grupo de navegación (para que aparezca en la parte inferior)
    public static function getNavigationGroup(): ?string
    {
        return __('Documentación');
    }
}
