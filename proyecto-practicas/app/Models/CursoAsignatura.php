<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoAsignatura extends Model
{
    use HasFactory;
    protected $table = 'curso_asignatura';

    protected $fillable = [
        'curso_id',
        'asignatura_id',
    ];
}
