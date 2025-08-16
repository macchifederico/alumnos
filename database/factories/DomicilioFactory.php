<?php

namespace Database\Factories;

use App\Models\Domicilio;
use App\Models\Alumno;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Domicilio>
 */
class DomicilioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Domicilio::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'calle' => $this->faker->streetName(),
            'numero' => $this->faker->buildingNumber(),
            'piso' => $this->faker->optional()->numberBetween(1, 10),
            'departamento' => $this->faker->optional()->bothify('?#'),
            'ciudad' => $this->faker->city(),
            'localidad' => $this->faker->city(),
            'provincia' => $this->faker->state(),
            'codigo_postal' => $this->faker->postcode(),
            'pais' => 'Argentina',
        ];
    }
}
