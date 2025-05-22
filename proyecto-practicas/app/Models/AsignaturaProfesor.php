<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignaturaProfesor extends Model
{
    use HasFactory;
protected $table = 'asignatura_profesor';

protected $fillable = [
    'asignatura_id',
    'profesor_id',
];
}
