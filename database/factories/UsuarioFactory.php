<?php

namespace Database\Factories;

use App\Models\Persona;
use App\Models\Rol;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idpersona' => Persona::factory(),
            'contrasena' => fake()->word(),
            'email' => fake()->email(),
            'habilitado' => fake()->boolean(),
            'fecha' => fake()->date(),
            'idrol' => Rol::factory(),
            'usuariocreacion' => fake()->userName(),
            'usuariomodificacion' => fake()->userName(),
        ];
    }
}
