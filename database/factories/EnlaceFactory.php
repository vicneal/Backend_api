<?php

namespace Database\Factories;

use App\Models\Pagina;
use App\Models\Rol;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enlace>
 */
class EnlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idpagina' => Pagina::factory(),
            'idrol' => Rol::factory(),
            'descripcion' => fake()->sentence(),
            'usuariocreacion' => fake()->userName(),
            'usuariomodificacion' => fake()->userName(),
        ];
    }
}
