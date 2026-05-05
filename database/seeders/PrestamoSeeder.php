<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PrestamoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prestamos')->insert([
            [
                'equipo_id' => 1,
                'alumno_id' => 1,
                'fecha_prestamo' => Carbon::now()->subDays(5),
                'fecha_devolucion' => Carbon::now()->addDays(2),
                'estado' => 'Prestado',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'equipo_id' => 2,
                'alumno_id' => 2,
                'fecha_prestamo' => Carbon::now()->subDays(10),
                'fecha_devolucion' => Carbon::now()->subDays(3),
                'estado' => 'Devuelto',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'equipo_id' => 3,
                'alumno_id' => 3,
                'fecha_prestamo' => Carbon::now()->subDays(15),
                'fecha_devolucion' => Carbon::now()->subDays(8),
                'estado' => 'Devuelto',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

