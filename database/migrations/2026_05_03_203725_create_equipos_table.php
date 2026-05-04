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
      Schema::create('equipos', function (Blueprint $table) {
          $table->id();
          $table->string('nombre');
          $table->string('tipo');
          $table->string('numero_serie');
          $table->string('marca');
          $table->string('modelo');
          $table->enum('estado', ['Disponible', 'Prestado', 'Dañado'])->default('Disponible');
          $table->timestamp('fecha_registro')->useCurrent();
          $table->timestamps();
      });
  }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
