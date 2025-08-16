<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    /** @use HasFactory<\Database\Factories\ProfesorFactory> */
    use HasFactory;

    protected $table = 'profesores';

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'email',
        'fecha_nacimiento',
        'nacionalidad',
        'telefono',
        'id_domicilio',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    // Relaciones
    public function domicilio()
    {
        return $this->belongsTo(Domicilio::class, 'id_domicilio');
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'profesor_curso', 'id_profesor', 'id_curso');
    }

    // Métodos auxiliares
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }

    public function getEdadAttribute()
    {
        return $this->fecha_nacimiento ? $this->fecha_nacimiento->age : null;
    }

    // Scopes
    public function scopeActivos($query)
    {
        return $query->whereHas('cursos');
    }

    public function scopePorNacionalidad($query, $nacionalidad)
    {
        return $query->where('nacionalidad', $nacionalidad);
    }
}
