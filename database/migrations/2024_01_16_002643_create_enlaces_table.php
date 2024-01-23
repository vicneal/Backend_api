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
        Schema::create('enlaces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idpagina');
            $table->unsignedBigInteger('idrol');
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->string('usuariocreacion');
            $table->string('usuariomodificacion')->nullable();
            $table->foreign('idpagina')->references('id')->on('paginas');
            $table->foreign('idrol')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enlaces');
    }
};
