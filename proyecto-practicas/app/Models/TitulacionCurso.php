<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitulacionCurso extends Model
{
    use HasFactory;
    protected $table = 'curso_titulacion';

    protected $fillable = [
        'curso_id',
        'titulacion_id',
    ];
}
