<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="Empresa",
 *     type="object",
 *     title="Empresa",
 *     required={"id", "nombre"},
 *     @OA\Property(property="id", type="integer", example=87),
 *     @OA\Property(property="nombre", type="string", example="Diputación de Málaga"),
 *     @OA\Property(property="tutor_laboral_id", type="integer", nullable=true, example=37),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-26T10:07:05Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-26T10:07:05Z")
 * )
 */

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tutor_laboral_id',
    ];

    public function tutores(): HasMany
    {
        return $this->hasMany(Tutor::class);
    }

    public function tutorLaboral(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tutor_laboral_id');
    }

}
