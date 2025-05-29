<?php

namespace App\Filament\Pages;

use App\Enums\Rol;
use Filament\Pages\Page;

class DocumentacionTutorDocente extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static string $view = 'filament.pages.documentacion-tutor-docente';
    protected static ?int $navigationSort = 91;

    public static function canAccess(): bool
    {
        return (auth()->check() && getUserRol() === Rol::TutorDocente) || (auth()->check() && getUserRol() === Rol::Admin);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Ayuda';
    }

    public static function getNavigationLabel(): string
    {
        if (auth()->check() && getUserRol() === Rol::Admin) {
            return 'Tutor Docente';
        }

        return 'Documentación';
    }

    public function getTitle(): string
    {
        return 'Documentación Tutor Docente';
    }
}
