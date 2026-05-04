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
     Schema::create('prestamos', function (Blueprint $table) {
         $table->id(); // folio
         $table->foreignId('equipo_id')->constrained('equipos'); // Relación con equipos
         $table->foreignId('alumno_id')->constrained('alumnos'); // Relación con alumnos
         $table->dateTime('fecha_prestamo');
         $table->dateTime('fecha_devolucion')->nullable();
         $table->enum('estado', ['Prestado', 'Devuelto', 'Retrasado'])->default('Prestado');
         $table->timestamps();
     });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
