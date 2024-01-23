<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['rol' => 'usuario', 'estado' => 1],
            ['rol' => 'administrador', 'estado' => 1],
        ];

        foreach ($roles as $role) {
            Rol::create($role);
        }
    }
}
