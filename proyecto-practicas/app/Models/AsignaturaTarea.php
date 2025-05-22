<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignaturaTarea extends Model
{
    use HasFactory;
    protected $table = 'asignatura_tarea';

    protected $fillable = [
        'asignatura_id',
        'tarea_id',
    ];
}
