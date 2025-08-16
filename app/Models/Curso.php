<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    /** @use HasFactory<\Database\Factories\CursoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'materia',
        'facultad',
        'vigencia',
        'precio',
        'tipo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'vigencia' => 'date',
    ];

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_curso', 'curso_id', 'alumno_id');
    }

    // Métodos auxiliares
    public function getCantidadAlumnosAttribute()
    {
        return $this->alumnos()->count();
    }

    public function estaVigente()
    {
        return $this->vigencia >= now()->toDateString();
    }

    // Scopes
    public function scopeVigentes($query)
    {
        return $query->where('vigencia', '>=', now()->toDateString());
    }

    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    public function scopePorFacultad($query, $facultad)
    {
        return $query->where('facultad', $facultad);
    }
}
