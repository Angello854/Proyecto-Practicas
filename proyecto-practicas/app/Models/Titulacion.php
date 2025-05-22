<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titulacion extends Model
{
    use HasFactory;
    protected $table = 'titulacion';
    protected $fillable = [
        'nombre',
    ];

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_titulacion', 'titulacion_id', 'curso_id');
    }

}
