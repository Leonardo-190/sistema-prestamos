<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AlumnoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('alumnos')->insert([
            [
                'matricula' => '122045678',
                'nombre' => 'Leonardo',
                'apellido_paterno' => 'García',
                'apellido_materno' => 'López',
                'carrera' => 'Sistemas Computacionales',
                'correo' => 'leonardo.garcia@example.com',
                'telefono' => '5551234567',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'matricula' => '122033221',
                'nombre' => 'Ana',
                'apellido_paterno' => 'Martínez',
                'apellido_materno' => 'Pérez',
                'carrera' => 'Mecatrónica',
                'correo' => 'ana.martinez@example.com',
                'telefono' => '5557654321',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'matricula' => '122045000',
                'nombre' => 'Juan',
                'apellido_paterno' => 'Rodríguez',
                'apellido_materno' => 'Silva',
                'carrera' => 'Ingeniería Civil',
                'correo' => 'juan.rodriguez@example.com',
                'telefono' => '5559876543',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'matricula' => '122044500',
                'nombre' => 'María',
                'apellido_paterno' => 'López',
                'apellido_materno' => 'González',
                'carrera' => 'Administración',
                'correo' => 'maria.lopez@example.com',
                'telefono' => '5555555555',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
