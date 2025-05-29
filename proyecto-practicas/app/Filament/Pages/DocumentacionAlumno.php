<?php

namespace App\Filament\Pages;

use App\Enums\Rol;
use Filament\Pages\Page;

class DocumentacionAlumno extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static string $view = 'filament.pages.documentacion-alumno';
    protected static ?int $navigationSort = 93;

    public static function canAccess(): bool
    {
        return (auth()->check() && getUserRol() === Rol::Alumno) || (auth()->check() && getUserRol() === Rol::Admin);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Ayuda';
    }

    public static function getNavigationLabel(): string
    {
        if (auth()->check() && getUserRol() === Rol::Admin) {
            return 'Alumno';
        }

        return 'Documentación';
    }

    public function getTitle(): string
    {
        return 'Documentación Alumno';
    }
}
