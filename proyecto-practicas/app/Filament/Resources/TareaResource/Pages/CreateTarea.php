<?php

namespace App\Filament\Resources\TareaResource\Pages;

use App\Enums\Rol;
use App\Filament\Resources\TareaResource;
use App\Models\AsignaturaTarea;
use App\Models\Tarea;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateTarea extends CreateRecord
{
    protected static string $resource = TareaResource::class;


    public function handleRecordCreation(array $data): Model
    {

        $user = auth()->user();


        if (!$user) {
            throw new \Exception("El usuario no está autenticado.");
        }

        $data['alumno_id'] = $user['id'];

        $asignaturas = $data['asignaturas'] ?? [];

        if (is_string($asignaturas)) {
            $asignaturas = explode(',', $asignaturas);
        }

        unset($data['asignaturas']);

        $tarea = Tarea::create($data);

        foreach ($asignaturas as $asignaturaId) {
            if (!empty($asignaturaId)) {
                AsignaturaTarea::create([
                    'tarea_id' => $tarea->id,
                    'asignatura_id' => $asignaturaId,
                ]);
            }
        }

        return $tarea;
    }
}
