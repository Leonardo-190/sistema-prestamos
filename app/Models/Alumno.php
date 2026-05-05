<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $fillable = ['matricula', 'nombre', 'apellido_paterno', 'apellido_materno', 'carrera', 'correo', 'telefono'];
    protected $table = 'alumnos';

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}
