<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
    ];

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'curso_asignatura', 'curso_id', 'asignatura_id');
    }

    public function titulaciones()
    {
        return $this->belongsToMany(Titulacion::class, 'curso_titulacion', 'curso_id', 'titulacion_id');
    }


}
