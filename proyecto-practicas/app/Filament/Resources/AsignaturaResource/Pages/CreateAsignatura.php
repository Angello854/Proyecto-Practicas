<?php

namespace App\Filament\Resources\AsignaturaResource\Pages;

use App\Filament\Resources\AsignaturaResource;
use App\Models\Asignatura;
use App\Models\AsignaturaProfesor;
use App\Models\Curso;
use App\Models\CursoAsignatura;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateAsignatura extends CreateRecord
{
    protected static string $resource = AsignaturaResource::class;


    public function handleRecordCreation(array $data): Model
    {
        // Asegurar que asignaturas sea siempre un array
        $profesores = $data['profesores'] ?? [];

        if (is_string($profesores)) {
            $profesores = explode(',', $profesores);
        }

        unset($data['profesores']);

        // Crear el curso
        $asignatura = Asignatura::create($data);

        // Crear las relaciones en la tabla intermedia
        foreach ($profesores as $profesoresId) {
            if (!empty($profesoresId)) {
                AsignaturaProfesor::create([
                    'asignatura_id' => $asignatura->id,
                    'profesor_id' => $profesoresId,
                ]);
            }
        }

        return $asignatura;
    }
}
