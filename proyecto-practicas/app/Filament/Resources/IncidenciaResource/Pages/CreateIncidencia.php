<?php

namespace App\Filament\Resources\IncidenciaResource\Pages;

use App\Filament\Resources\IncidenciaResource;
use App\Models\Incidencia;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateIncidencia extends CreateRecord
{
    protected static string $resource = IncidenciaResource::class;

    public function handleRecordCreation(array $data): Model
    {
        $data['usuario_id'] = getUserId();

        $incidencia = Incidencia::create($data);

        return $incidencia;
    }
}
