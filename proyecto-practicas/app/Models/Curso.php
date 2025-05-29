<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Curso",
 *     type="object",
 *     title="Curso",
 *     required={"id", "nombre"},
 *     @OA\Property(property="id", type="integer", example=86),
 *     @OA\Property(property="nombre", type="string", example="1º DAW"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-26T10:13:33Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-26T10:14:32Z")
 * )
 */

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
