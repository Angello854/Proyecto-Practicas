<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\AlumnoProfesor;
use App\Models\Titulacion;
use App\Models\TitulacionCurso;
use App\Models\Tutor;
use App\Models\User;
use Exception;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\NoReturn;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;



    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {

        $user = User::create($data);


        if ($data['rol'] === 'alumno') {
            Tutor::create([
                'alumno_id' => $user->id,
                'tutor_docente_id' => $data['tutor_docente_id'],
                'tutor_laboral_id' => $data['tutor_laboral_id'],
                'empresa_id' => $data['empresa_id'],
            ]);
            $profesores = $data['profesores'] ?? [];

            if (is_string($profesores)) {
                $profesores = explode(',', $profesores);
            }

            unset($data['profesores']);

            foreach ($profesores as $profesorId) {
                if (!empty($profesorId)) {
                    AlumnoProfesor::create([
                        'alumno_id' => $user->id,
                        'profesor_id' => $profesorId,
                    ]);
                }
            }
        }

        return $user;
    }
}
