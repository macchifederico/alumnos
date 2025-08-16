<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profesor>
 */
class ProfesorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'dni' => $this->faker->unique()->numerify('########'),
            'email' => $this->faker->unique()->safeEmail(),
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-65 years', '-25 years')->format('Y-m-d'),
            'nacionalidad' => $this->faker->randomElement(['Argentina', 'Brasil', 'Chile', 'Uruguay', 'Paraguay', 'España', 'Italia']),
            'telefono' => $this->faker->phoneNumber(),
        ];
    }
}
