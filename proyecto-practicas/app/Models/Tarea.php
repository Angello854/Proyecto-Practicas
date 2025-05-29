<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @OA\Schema(
 *     schema="Tarea",
 *     type="object",
 *     title="Tarea",
 *     required={"id", "descripcion", "fecha", "horas", "materiales", "alumno_id"},
 *     @OA\Property(property="id", type="integer", example=156),
 *     @OA\Property(property="descripcion", type="string", example="Hola"),
 *     @OA\Property(property="fecha", type="string", format="date", example="2025-05-26"),
 *     @OA\Property(property="aprendizaje", type="string", nullable=true, example="Hola"),
 *     @OA\Property(property="refuerzo", type="string", nullable=true, example="Hola"),
 *     @OA\Property(property="horas", type="integer", example=5),
 *     @OA\Property(property="materiales", type="string", example="equipo propio"),
 *     @OA\Property(property="comentarios", type="string", nullable=true, example="<p>Hola a todos</p>"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-26T10:11:49.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-26T10:11:49.000000Z"),
 *     @OA\Property(property="alumno_id", type="integer", example=1)
 * )
 */

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
