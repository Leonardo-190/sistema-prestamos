<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alumnos')->insert([
            [
                'matricula' => '122045678',
                'nombre' => 'Leonardo',
                'apellido_paterno' => 'García',
                'apellido_materno' => 'López',
                'carrera' => 'Sistemas',
                'correo' => 'leonardo.garcia@example.com',
                'telefono' => '5551234567',
            ],
            [
                'matricula' => '122033221',
                'nombre' => 'Ana',
                'apellido_paterno' => 'Martínez',
                'apellido_materno' => 'Pérez',
                'carrera' => 'Mecatrónica',
                'correo' => 'ana.martinez@example.com',
                'telefono' => '5557654321',
            ],
        ]);
    }
}
