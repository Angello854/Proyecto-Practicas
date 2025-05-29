<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="Plugin",
 *     title="Plugin",
 *     required={"id", "nombre", "creador_id", "entorno"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nombre", type="string", example="Logger"),
 *     @OA\Property(property="descripcion", type="string", nullable=true, example="Plugin para registrar eventos."),
 *     @OA\Property(property="entorno", type="string", example="filament"),
 *     @OA\Property(property="creador_id", type="integer", example=1),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-28T08:08:51.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-28T08:31:51.000000Z")
 * )
 */

class Plugin extends Model
{
    protected $table = 'plugins';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'descripcion',
        'creador_id',
        'entorno'
    ];

    public function creador(): BelongsTo {
        return $this->belongsTo(Creador::class, 'creador_id','id','creadores');
    }
}
