<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tutor extends Model
{

    public $incrementing = false;
    protected $primaryKey = 'alumno_id';
    protected $keyType = 'int';

    protected $table = 'tutores';

    protected $fillable = [
        'alumno_id',
        'tutor_docente_id',
        'tutor_laboral_id',
        'empresa_id',
    ];

    public function alumno(): BelongsTo
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }

    public function tutorDocente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tutor_docente_id');
    }

    public function tutorLaboral(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tutor_laboral_id');
    }

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

}
