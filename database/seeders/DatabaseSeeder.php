<?php

namespace Database\Seeders;

use App\Models\Alumno;
use App\Models\Curso;
use App\Models\Domicilio;
use App\Models\Profesor;
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

        User::firstOrCreate(
            ['email' => 'federico.macchi@gmail.com'],
            [
                'name' => 'Federico Macchi',
                'password' => bcrypt('fedemacchi')
            ]
        );

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

        // Crear alumnos con sus domicilios
        $alumnos = Alumno::factory(10)->create();

        // Crear domicilios para cada alumno
        $alumnos->each(function ($alumno) {
            Domicilio::factory()->create([
                'id_alumno' => $alumno->id
            ]);
        });

        // Asignar cursos aleatorios a algunos alumnos
        $cursos = Curso::all();
        $alumnos->each(function ($alumno) use ($cursos) {
            $alumno->cursos()->attach(
                $cursos->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // Crear profesores con sus domicilios
        $profesores = Profesor::factory(6)->create();

        // Crear domicilios para cada profesor
        $profesores->each(function ($profesor) {
            Domicilio::factory()->create([
                'id_alumno' => null, // Añadiremos una columna id_profesor después
                'id_profesor' => $profesor->id
            ]);
        });

        // Asignar cursos aleatorios a profesores
        $profesores->each(function ($profesor) use ($cursos) {
            $profesor->cursos()->attach(
                $cursos->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
    }
}
