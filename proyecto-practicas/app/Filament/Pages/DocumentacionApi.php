<?php

namespace App\Filament\Pages;

use App\Enums\Rol;
use Filament\Pages\Page;

class DocumentacionApi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-bars-3';
    protected static string $view = 'filament.pages.documentacion-api';

    protected static ?string $title = 'API';
    protected static ?string $navigationGroup = 'Documentación';

    public static function canAccess(): bool
    {
        return getUserRol() === Rol::Admin;
    }
}
