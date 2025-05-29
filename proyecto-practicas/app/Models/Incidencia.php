<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *     schema="Incidencia",
 *     title="Incidencia",
 *     required={"id", "titulo", "usuario_id", "contenido"},
 *     @OA\Property(property="id", type="integer", example=5),
 *     @OA\Property(property="titulo", type="string", example="Hola"),
 *     @OA\Property(property="usuario_id", type="integer", example=1),
 *     @OA\Property(
 *         property="contenido",
 *         type="string",
 *         format="html",
 *         example="<p><strong><em>Adiós</em></strong><br></p>"
 *     ),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-28T10:47:22.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-28T10:47:22.000000Z")
 * )
 */

class Incidencia extends Model
{
    protected $table = 'incidencias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'titulo',
        'contenido',
        'usuario_id',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id','id');
    }
}
