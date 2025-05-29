<?php

namespace App\Filament\Pages;

use App\Enums\Rol;
use Filament\Pages\Page;

class DocumentacionTutorLaboral extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static string $view = 'filament.pages.documentacion-tutor-laboral';
    protected static ?int $navigationSort = 92;

    public static function canAccess(): bool
    {
        return (auth()->check() && getUserRol() === Rol::TutorLaboral) || (auth()->check() && getUserRol() === Rol::Admin);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Ayuda';
    }

    public static function getNavigationLabel(): string
    {
        if (auth()->check() && getUserRol() === Rol::Admin) {
            return 'Tutor Laboral';
        }

        return 'Documentación';
    }

    public function getTitle(): string
    {
        return 'Documentación Tutor Laboral';
    }
}
