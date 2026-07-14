<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombreProducto' => fake()->words(3, true),
            'descripcion' => fake()->sentence(),
            'precio' => fake()->randomFloat(2, 1, 500),
            'stock' => fake()->numberBetween(0, 100),
            'estado' => true,
        ];
    }
}
