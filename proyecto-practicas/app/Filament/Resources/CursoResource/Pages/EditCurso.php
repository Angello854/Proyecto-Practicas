<?php

namespace App\Filament\Resources\CursoResource\Pages;

use App\Filament\Resources\CursoResource;
use App\Models\CursoAsignatura;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCurso extends EditRecord
{
    protected static string $resource = CursoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($this->record) {
            // Asegurarse de que sea un array (aunque venga como string con comas)
            $asignaturas = $data['asignaturas'] ?? [];

            if (is_string($asignaturas)) {
                $asignaturas = explode(',', $asignaturas);
            }

            if (!is_array($asignaturas)) {
                $asignaturas = [];
            }

            // Eliminar asignaciones anteriores
            CursoAsignatura::where('curso_id', $this->record->id)->delete();

            // Insertar nuevas asignaciones
            foreach ($asignaturas as $asignaturaId) {
                CursoAsignatura::create([
                    'curso_id' => $this->record->id,
                    'asignatura_id' => $asignaturaId,
                ]);
            }
        }

        // Eliminar 'asignaturas' antes de guardar el modelo Curso
        unset($data['asignaturas']);

        return $data;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Si estamos editando un curso, cargamos las asignaturas
        if ($this->record) {
            // Asignaturas actuales del curso
            $asignaturasIds = $this->record->asignaturas()
                ->pluck('asignaturas.id')  // Especificamos 'asignaturas.id' para evitar la ambigüedad
                ->toArray();

            // Modificar los datos para que asignaturas tenga las asignaturas del curso
            $data['asignaturas'] = $asignaturasIds;
        }
        return $data;
    }

}
