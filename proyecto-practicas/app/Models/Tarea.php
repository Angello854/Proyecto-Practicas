<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'fecha',
        'aprendizaje',
        'refuerzo',
        'horas',
        'materiales',
        'comentarios',
        'alumno_id'
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];


    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class,'alumno_id');
    }

    public function asignaturas(): BelongsToMany
    {
        return $this->belongsToMany(Asignatura::class,'asignatura_tarea', 'tarea_id', 'asignatura_id');
    }


}
