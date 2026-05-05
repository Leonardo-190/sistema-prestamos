<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $fillable = ['nombre', 'tipo', 'numero_serie', 'marca', 'modelo', 'estado', 'fecha_registro'];
    protected $table = 'equipos';

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}
