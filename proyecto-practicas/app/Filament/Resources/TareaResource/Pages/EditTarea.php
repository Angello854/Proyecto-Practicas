<?php

namespace App\Filament\Resources\TareaResource\Pages;

use App\Filament\Resources\TareaResource;
use App\Models\AsignaturaTarea;
use App\Models\TitulacionCurso;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTarea extends EditRecord
{
    protected static string $resource = TareaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($this->record) {
            $asignaturas = $data['asignaturas'] ?? [];

            if (is_string($asignaturas)) {
                $asignaturas = explode(',', $asignaturas);
            }

            if (!is_array($asignaturas)) {
                $asignaturas = [];
            }

            AsignaturaTarea::where('tarea_id', $this->record->id)->delete();

            foreach ($asignaturas as $asignaturaId) {
                AsignaturaTarea::create([
                    'tarea_id' => $this->record->id,
                    'asignatura_id' => $asignaturaId,
                ]);
            }
        }

        unset($data['asignaturas']);

        return $data;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($this->record) {
            $asignaturasId = $this->record->asignaturas()
                ->pluck('asignaturas.id')
                ->toArray();
            $data['asignaturas'] = $asignaturasId;
        }
        return $data;
    }
}
