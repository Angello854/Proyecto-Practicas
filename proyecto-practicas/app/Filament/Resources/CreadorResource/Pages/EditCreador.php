<?php

namespace App\Filament\Resources\CreadorResource\Pages;

use App\Filament\Resources\CreadorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCreador extends EditRecord
{
    protected static string $resource = CreadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
