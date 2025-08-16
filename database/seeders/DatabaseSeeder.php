<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Federico Macchi',
            'email' => 'federico.macchi@gmail.com',
            'password' => bcrypt('fedemacchi')
        ]);

        Curso::factory()->create([
            'nombre' => 'Curso de PHP',
            'materia' => 'Programación Web',
            'facultad' => 'Facultad de Ingeniería',
            'vigencia' => '2025-12-31',
            'precio' => 15000,
            'tipo' => 'Presencial'
        ]);

        Curso::factory()->create([
            'nombre' => 'Curso de JAVA',
            'materia' => 'Programación Web',
            'facultad' => 'Facultad de Ingeniería',
            'vigencia' => '2025-12-31',
            'precio' => 15000,
            'tipo' => 'Presencial'
        ]);

        Curso::factory()->create([
            'nombre' => 'Curso de JavaScript',
            'materia' => 'Desarrollo Frontend',
            'facultad' => 'Facultad de Ciencias Exactas',
            'vigencia' => '2025-11-30',
            'precio' => 12000,
            'tipo' => 'Virtual'
        ]);

        Curso::factory()->create([
            'nombre' => 'Curso de Python',
            'materia' => 'Ciencia de Datos',
            'facultad' => 'Facultad de Ciencias',
            'vigencia' => '2025-10-15',
            'precio' => 18000,
            'tipo' => 'Presencial'
        ]);

        Curso::factory()->create([
            'nombre' => 'Curso de Java',
            'materia' => 'Programación Orientada a Objetos',
            'facultad' => 'Facultad de Ingeniería',
            'vigencia' => '2025-09-20',
            'precio' => 16000,
            'tipo' => 'Virtual'
        ]);

        Curso::factory()->create([
            'nombre' => 'Curso de Bases de Datos',
            'materia' => 'Sistemas de Información',
            'facultad' => 'Facultad de Informática',
            'vigencia' => '2025-08-31',
            'precio' => 14000,
            'tipo' => 'Presencial'
        ]);
    }
}
