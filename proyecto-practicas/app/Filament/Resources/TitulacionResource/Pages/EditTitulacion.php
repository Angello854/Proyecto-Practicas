<?php

namespace App\Filament\Resources\TitulacionResource\Pages;

use App\Filament\Resources\TitulacionResource;
use App\Models\CursoAsignatura;
use App\Models\TitulacionCurso;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTitulacion extends EditRecord
{
    protected static string $resource = TitulacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($this->record) {
            $cursos = $data['cursos'] ?? [];

            if (is_string($cursos)) {
                $cursos = explode(',', $cursos);
            }

            if (!is_array($cursos)) {
                $cursos = [];
            }

            TitulacionCurso::where('titulacion_id', $this->record->id)->delete();

            foreach ($cursos as $cursoId) {
                TitulacionCurso::create([
                    'titulacion_id' => $this->record->id,
                    'curso_id' => $cursoId,
                ]);
            }
        }

        unset($data['cursos']);

        return $data;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($this->record) {
            $cursosId = $this->record->cursos()
                ->pluck('cursos.id')
                ->toArray();
            $data['cursos'] = $cursosId;
        }
        return $data;
    }

}
