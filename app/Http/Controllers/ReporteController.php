<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index()
    {
        $equipos_total = DB::table('equipos')->count();
        $equipos_disponibles = DB::table('equipos')->where('estado', 'disponible')->count();
        $prestamos_activos = DB::table('prestamos')->where('estado', 'activo')->count();
        $alumnos_total = DB::table('alumnos')->count();

        return view('reportes.index', compact('equipos_total', 'equipos_disponibles', 'prestamos_activos', 'alumnos_total'));
    }
}

