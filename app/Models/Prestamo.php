<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $fillable = ['equipo_id', 'alumno_id', 'fecha_prestamo', 'fecha_devolucion', 'estado'];
    protected $table = 'prestamos';

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
