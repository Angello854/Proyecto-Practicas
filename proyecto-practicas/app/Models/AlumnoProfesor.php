<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoProfesor extends Model
{
    use HasFactory;

protected $table = 'alumno_profesor';
protected $fillable = [
    'alumno_id',
    'profesor_id',
];
}
