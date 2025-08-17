<?php

namespace App\Policies;

use App\Models\Alumno;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AlumnoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->tienePermiso('alumnos.read') || $user->esAdmin() || $user->esGestor();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Alumno $alumno): bool
    {
        return $user->tienePermiso('alumnos.read') || $user->esAdmin() || $user->esGestor();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->tienePermiso('alumnos.create') || $user->esAdmin() || $user->esGestor();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Alumno $alumno): bool
    {
        return $user->tienePermiso('alumnos.update') || $user->esAdmin() || $user->esGestor();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Alumno $alumno): bool
    {
        return $user->tienePermiso('alumnos.delete') || $user->esAdmin() || $user->esGestor();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Alumno $alumno): bool
    {
        return $user->esAdmin(); // Solo admin puede restaurar
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Alumno $alumno): bool
    {
        return $user->esAdmin(); // Solo admin puede eliminar permanentemente
    }
}
