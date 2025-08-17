<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Solo los admins pueden ver la lista de usuarios
        return $user->esAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        // Solo los admins pueden ver usuarios individuales
        return $user->esAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Solo los admins pueden crear usuarios
        return $user->esAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        // Solo los admins pueden actualizar usuarios
        return $user->esAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        // Solo los admins pueden eliminar usuarios
        // Pero un usuario no puede eliminarse a sí mismo
        return $user->esAdmin() && $user->id !== $model->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        // Solo los admins pueden restaurar usuarios
        return $user->esAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        // Solo los admins pueden eliminar permanentemente usuarios
        // Pero un usuario no puede eliminarse a sí mismo
        return $user->esAdmin() && $user->id !== $model->id;
    }
}
