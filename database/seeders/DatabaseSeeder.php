<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $rolSeeder = new RolSeeder();
        $rolSeeder->run();
        $personaSeeder = new PersonaSeeder();
        $personaSeeder->run();
        $paginaSeeder = new PaginaSeeder();
        $paginaSeeder->run();
        $enlaceSeeder = new EnlaceSeeder();
        $enlaceSeeder->run();
        $usuarioSeeder = new UsuarioSeeder();
        $usuarioSeeder->run();
        $bitacoraSeeder = new BitacoraSeeder();
        $bitacoraSeeder->run();
    }
}
