<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idpersona');
            $table->string('contrasena');
            $table->string('email')->unique(); //eliminar por que ya existe un usuario que representa el email creo xd
            $table->boolean('habilitado')->default(true);
            $table->date('fecha');
            $table->unsignedBigInteger('idrol');
            $table->timestamps();
            $table->string('usuariocreacion')->nullable();
            $table->string('usuariomodificacion')->nullable();
            $table->foreign('idpersona')->references('id')->on('personas');
            $table->foreign('idrol')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
