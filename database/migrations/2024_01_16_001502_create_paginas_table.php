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
        Schema::create('paginas', function (Blueprint $table) {
            $table->id();
            $table->timestamp('usuariocreacion')->nullable();
            $table->timestamp('usuariomodificacion')->nullable();
            $table->string('url')->nullable();
            $table->boolean('estado')->nullable();
            $table->string('nombre')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('icono')->nullable();
            $table->string('tipo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paginas');
    }
};
