<?php

namespace App\Policies;

use App\Enums\Rol;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CursoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return getUserRol() === Rol::TutorDocente ||  getUserRol() === Rol::Admin;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Curso $curso): bool
    {
        return getUserRol() === Rol::TutorDocente ||  getUserRol() === Rol::Admin;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return getUserRol() === Rol::Admin;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Curso $curso): bool
    {
        return getUserRol() === Rol::TutorDocente ||  getUserRol() === Rol::Admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Curso $curso): bool
    {
        return getUserRol() === Rol::Admin;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Curso $curso): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Curso $curso): bool
    {
        return false;
    }
}
