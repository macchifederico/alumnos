<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    /** @use HasFactory<\Database\Factories\DomicilioFactory> */
    use HasFactory;

    protected $fillable = [
        'id_alumno',
        'calle',
        'numero',
        'localidad',
        'provincia',
        'codigo_postal',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'id_alumno');
    }

    // Métodos auxiliares
    public function getDireccionCompletaAttribute()
    {
        return "{$this->calle} {$this->numero}, {$this->localidad}, {$this->provincia} ({$this->codigo_postal})";
    }

    // Scopes
    public function scopePorProvincia($query, $provincia)
    {
        return $query->where('provincia', $provincia);
    }

    public function scopePorLocalidad($query, $localidad)
    {
        return $query->where('localidad', $localidad);
    }
}
