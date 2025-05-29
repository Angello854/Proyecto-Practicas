<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="Creador",
 *     title="Creador",
 *     required={"id", "nombre"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nombre", type="string", example="ZedoX"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-28T08:07:10.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-28T08:07:10.000000Z")
 * )
 */

class Creador extends Model
{
    protected $table = 'creadores';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
    ];

    public function plugins(): HasMany {
        return $this->hasMany(Plugin::class, 'creador_id', 'id');
    }

}
