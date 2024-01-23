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
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id('idbitacora');
            $table->text('bitacora');
            $table->unsignedBigInteger('idusuario');
            $table->date('fecha');
            $table->time('hora');
            $table->string('ip');
            $table->string('so');
            $table->string('usuarios');
            $table->string('navegador');
            $table->timestamps();
            $table->string('usuariocreacion');
            $table->string('usuariomodificacion')->nullable();
            $table->foreign('idusuario')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacoras');
    }
};
