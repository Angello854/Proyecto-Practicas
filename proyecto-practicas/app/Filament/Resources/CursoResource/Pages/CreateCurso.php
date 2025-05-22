<?php

namespace App\Filament\Resources\CursoResource\Pages;

use App\Filament\Resources\CursoResource;
use App\Models\Curso;
use App\Models\CursoAsignatura;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCurso extends CreateRecord
{
    protected static string $resource = CursoResource::class;

    public function handleRecordCreation(array $data): Model
    {
        // Asegurar que asignaturas sea siempre un array
        $asignaturas = $data['asignaturas'] ?? [];

        if (is_string($asignaturas)) {
            $asignaturas = explode(',', $asignaturas);
        }

        unset($data['asignaturas']);

        // Crear el curso
        $curso = Curso::create($data);

        // Crear las relaciones en la tabla intermedia
        foreach ($asignaturas as $asignaturaId) {
            if (!empty($asignaturaId)) {
                CursoAsignatura::create([
                    'curso_id' => $curso->id,
                    'asignatura_id' => $asignaturaId,
                ]);
            }
        }

        return $curso;
    }

}
