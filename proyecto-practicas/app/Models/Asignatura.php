<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asignatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'asignatura_tarea', 'asignatura_id', 'tarea_id');
    }

    public function profesores()
    {
        return $this->belongsToMany(User::class, 'asignatura_profesor', 'asignatura_id', 'profesor_id')
            ->where('rol', 'tutor_docente');
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_asignatura', 'asignatura_id', 'curso_id');
    }

}
