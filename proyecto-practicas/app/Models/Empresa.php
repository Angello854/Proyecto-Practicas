<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
