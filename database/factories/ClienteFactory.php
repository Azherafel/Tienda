<?php

namespace Database\Factories;

use App\Models\cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'apellidoP' => $this->faker->randomElement(['García', 'Rodríguez', 'López', 'Martínez', 'Hernández']),
            'apellidoM' => $this->faker->randomElement(['González', 'Rodríguez', 'López', 'Martínez', 'Hernández']),
            'telefono' => $this->faker->tollFreePhoneNumber(),
            'correo' => $this->faker->unique()->safeEmail(),
        ];
    }
}
