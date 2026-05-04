<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
        DB::table('equipos')->insert([
            [
                'nombre' => 'Laptop Latitude',
                'numero_serie' => 'DELL001',
                'estado' => 'Disponible',
                'tipo' => 'Computo',
                'marca' => 'Dell',
                'modelo' => '5420',
            ],
            [
                'nombre' => 'Proyector',
                'numero_serie' => 'EPS2024',
                'estado' => 'Disponible',
                'tipo' => 'Audiovisual',
                'marca' => 'Epson',
                'modelo' => 'PowerLite',
            ],
            [
                'nombre' => 'Kit de Arduino Uno',
                'numero_serie' => 'ARD-05',
                'estado' => 'Dañado',
                'tipo' => 'Electrónica',
                'marca' => 'Arduino',
                'modelo' => 'R3',
            ],
        ]);
    }
}
