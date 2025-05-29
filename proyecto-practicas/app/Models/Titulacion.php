<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Titulacion",
 *     type="object",
 *     title="Titulación",
 *     required={"id", "nombre"},
 *     @OA\Property(property="id", type="integer", example=86),
 *     @OA\Property(property="nombre", type="string", example="Técnico Superior DAW"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-26T10:14:14Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-26T10:14:14Z")
 * )
 */

class Titulacion extends Model
{
    use HasFactory;
    protected $table = 'titulacion';
    protected $fillable = [
        'nombre',
    ];

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_titulacion', 'titulacion_id', 'curso_id');
    }

}
