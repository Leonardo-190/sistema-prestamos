<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EquipoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('equipos')->insert([
            [
                'nombre' => 'Laptop Dell Latitude 5420',
                'numero_serie' => 'DELL001',
                'estado' => 'Disponible',
                'tipo' => 'Laptop',
                'marca' => 'Dell',
                'modelo' => '5420',
                'fecha_registro' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Laptop HP Pavilion 15',
                'numero_serie' => 'HP001',
                'estado' => 'Disponible',
                'tipo' => 'Laptop',
                'marca' => 'HP',
                'modelo' => 'Pavilion 15',
                'fecha_registro' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Proyector Epson',
                'numero_serie' => 'EPS2024',
                'estado' => 'Disponible',
                'tipo' => 'Proyector',
                'marca' => 'Epson',
                'modelo' => 'PowerLite',
                'fecha_registro' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Arduino Uno',
                'numero_serie' => 'ARD-05',
                'estado' => 'Dañado',
                'tipo' => 'Electrónica',
                'marca' => 'Arduino',
                'modelo' => 'R3',
                'fecha_registro' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Monitor Samsung 24"',
                'numero_serie' => 'SAM-MON-001',
                'estado' => 'Disponible',
                'tipo' => 'Monitor',
                'marca' => 'Samsung',
                'modelo' => 'LU28E590DS',
                'fecha_registro' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Teclado Mecánico RGB',
                'numero_serie' => 'KBD-001',
                'estado' => 'Disponible',
                'tipo' => 'Periférico',
                'marca' => 'Corsair',
                'modelo' => 'K70 RGB',
                'fecha_registro' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
