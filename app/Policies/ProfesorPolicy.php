<?php

namespace App\Policies;

use App\Models\Profesor;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProfesorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Gestor solo puede consultar, Admin puede todo
        return $user->tienePermiso('profesores.read') || $user->esAdmin() || $user->esGestor();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Profesor $profesor): bool
    {
        return $user->tienePermiso('profesores.read') || $user->esAdmin() || $user->esGestor();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Solo admin puede crear profesores, gestor NO
        return $user->tienePermiso('profesores.create') || $user->esAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Profesor $profesor): bool
    {
        // Solo admin puede editar profesores, gestor NO
        return $user->tienePermiso('profesores.update') || $user->esAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Profesor $profesor): bool
    {
        // Solo admin puede eliminar profesores, gestor NO
        return $user->tienePermiso('profesores.delete') || $user->esAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Profesor $profesor): bool
    {
        return $user->esAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Profesor $profesor): bool
    {
        return $user->esAdmin();
    }
}
