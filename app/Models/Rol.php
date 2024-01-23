<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = "roles";
    protected $fillable = [
        'rol',
        'estado'
        // Otros campos que puedas tener en tu tabla roles
        // 'usuariocreacion',
        // 'usuariomodificacion',
    ];
}
