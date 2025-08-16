<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    /** @use HasFactory<\Database\Factories\AlumnoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'dnicuitcuil',
        'fecha_nacimiento',
        'nacionalidad',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    public function domicilio()
    {
        return $this->hasOne(Domicilio::class, 'id_alumno');
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'alumno_curso', 'alumno_id', 'curso_id');
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
