<?php

namespace App\Filament\Resources\AsignaturaResource\Pages;

use App\Filament\Resources\AsignaturaResource;
use App\Models\AsignaturaProfesor;
use App\Models\CursoAsignatura;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAsignatura extends EditRecord
{
    protected static string $resource = AsignaturaResource::class;

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
            $profesores = $data['profesores'] ?? [];

            if (is_string($profesores)) {
                $profesores = explode(',', $profesores);
            }

            if (!is_array($profesores)) {
                $profesores = [];
            }

            // Eliminar asignaciones anteriores
            AsignaturaProfesor::where('asignatura_id', $this->record->id)->delete();

            // Insertar nuevas asignaciones
            foreach ($profesores as $profesoresId) {
                AsignaturaProfesor::create([
                    'asignatura_id' => $this->record->id,
                    'profesor_id' => $profesoresId,
                ]);
            }
        }

        // Eliminar 'asignaturas' antes de guardar el modelo Curso
        unset($data['profesores']);

        return $data;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Si estamos editando una asignatura, cargamos los profesores
        if ($this->record) {
            // Obtener los IDs de los profesores relacionados con la asignatura
            $profesoresIds = $this->record->profesores()
                ->pluck('users.id')  // Especificamos 'users.id' para evitar la ambigüedad
                ->toArray();

            // Modificar los datos para que el campo 'profesores' tenga los IDs de los profesores relacionados
            $data['profesores'] = $profesoresIds;
        }

        return $data;
    }

}
