<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bitacora>
 */
class BitacoraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bitacora' => fake()->sentence(),
            'idusuario' => Usuario::factory(),
            'fecha' => fake()->date(),
            'hora' => fake()->time(),
            'ip' => fake()->ipv4(),
            'so' => fake()->word(),
            'usuarios' => fake()->userName(),
            'navegador' => fake()->word(),
            'usuariocreacion' => fake()->userName(),
            'usuariomodificacion' => fake()->userName(),
        ];
    }
}
