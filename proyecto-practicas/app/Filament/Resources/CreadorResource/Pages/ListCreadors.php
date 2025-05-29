<?php

namespace App\Filament\Resources\CreadorResource\Pages;

use App\Filament\Resources\CreadorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCreadors extends ListRecords
{
    protected static string $resource = CreadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
