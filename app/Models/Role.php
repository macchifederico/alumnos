<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'permisos'
    ];

    protected $casts = [
        'permisos' => 'array'
    ];

    // Relaciones
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    // Métodos auxiliares
    public function tienePermiso(string $permiso): bool
    {
        return in_array($permiso, $this->permisos ?? []);
    }

    // Constantes de roles
    public const ADMIN = 'admin';
    public const GESTOR = 'gestor';
}
