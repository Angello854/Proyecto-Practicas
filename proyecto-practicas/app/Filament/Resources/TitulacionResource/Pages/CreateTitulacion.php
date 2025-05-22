<?php

namespace App\Filament\Resources\TitulacionResource\Pages;

use App\Filament\Resources\TitulacionResource;
use App\Models\Curso;
use App\Models\CursoAsignatura;
use App\Models\Titulacion;
use App\Models\TitulacionCurso;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateTitulacion extends CreateRecord
{
    protected static string $resource = TitulacionResource::class;

    public function handleRecordCreation(array $data): Model
    {
        $cursos = $data['cursos'] ?? [];

        if (is_string($cursos)) {
            $cursos = explode(',', $cursos);
        }

        unset($data['cursos']);

        $titulacion = Titulacion::create($data);

        foreach ($cursos as $cursoId) {
            if (!empty($cursoId)) {
                TitulacionCurso::create([
                    'titulacion_id' => $titulacion->id,
                    'curso_id' => $cursoId,
                ]);
            }
        }

        return $titulacion;
    }
}
