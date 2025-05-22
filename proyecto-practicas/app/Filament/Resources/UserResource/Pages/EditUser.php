<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\AlumnoProfesor;
use App\Models\Tutor;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JetBrains\PhpStorm\NoReturn;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }



    protected function mutateFormDataBeforeSave(array $data): array
    {


        if($data['rol'] === 'alumno'){
            Tutor::updateOrCreate(
                ['alumno_id' => $this->record->id],
                [
                    'tutor_docente_id' => $data['tutor_docente_id'],
                    'tutor_laboral_id' => $data['tutor_laboral_id'],
                    'empresa_id' => $data['empresa_id'],
                ]
            );
        }

        if ($this->record) {
            $profesores = $data['profesores'] ?? [];

            if (is_string($profesores)) {
                $profesores = explode(',', $profesores);
            }

            if (!is_array($profesores)) {
                $profesores = [];
            }

            AlumnoProfesor::where('alumno_id', $this->record->id)->delete();

            foreach ($profesores as $profesorId) {
                AlumnoProfesor::create([
                    'alumno_id' => $this->record->id,
                    'profesor_id' => $profesorId,
                ]);
            }
        }

        return $data;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['tutor_docente_id'] = $this->record->tutor->tutor_docente_id ?? null;
        $data['tutor_laboral_id'] = $this->record->tutor->tutor_laboral_id ?? null;
        $data['empresa_id'] = $this->record->tutor->empresa_id ?? null;

        if ($this->record) {
            $profesoresId = $this->record->profesores()
                ->pluck('users.id')
                ->toArray();
            $data['profesores'] = $profesoresId;
        }

        return $data;
    }


}
