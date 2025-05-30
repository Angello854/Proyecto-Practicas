<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Rol;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel\Concerns\HasAvatars;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Jeffgreco13\FilamentBreezy\Models\BreezySession;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="Usuario",
 *     required={"id", "name", "email", "rol"},
 *     @OA\Property(property="id", type="integer", example=2),
 *     @OA\Property(property="name", type="string", example="Pedro"),
 *     @OA\Property(property="email", type="string", format="email", example="pedro@gmail.com"),
 *     @OA\Property(property="email_verified_at", type="string", format="date-time", nullable=true, example=null),
 *     @OA\Property(property="telefono", type="string", nullable=true, example=null),
 *     @OA\Property(property="avatar_url", type="string", nullable=true, example=null),
 *     @OA\Property(property="rol", type="string", example="admin"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-21T08:40:41.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-21T08:43:15.000000Z"),
 *
 *     @OA\Property(
 *         property="breezy_sessions",
 *         type="array",
 *         @OA\Items(type="object"),
 *         example={}
 *     )
 * )
 */

class User extends Authenticatable implements HasAvatar
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
        'telefono',
        'rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $guarded = [
        'tutor_docente_id',
        'tutor_laboral_id',
        'empresa_id'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'rol' => Rol::class,
        ];
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->getAttribute('avatar_url') ? Storage::url($this->getAttribute('avatar_url')) : null;
    }

    public function sesion(): HasOne
    {
        return $this->hasOne(BreezySession::class, 'authenticatable_id', 'id');
    }

    public function tutor(): HasOne
    {
        return $this->hasOne(Tutor::class, 'alumno_id');
    }

    public function tareas(): HasMany
    {
        return $this->hasMany(Tarea::class);
    }

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'asignatura_profesor', 'profesor_id', 'asignatura_id');
    }

    public function profesores()
    {
        return $this->belongsToMany(User::class, 'alumno_profesor', 'alumno_id', 'profesor_id')
            ->where('users.rol', 'tutor_docente');
    }

    public function alumnos()
    {
        return $this->belongsToMany(User::class, 'alumno_profesor', 'profesor_id', 'alumno_id')
            ->where('users.rol', 'alumno');
    }

    public function incidendias(): HasMany
    {
        return $this->hasMany(Incidencia::class,'usuario_id','id');
    }
}
