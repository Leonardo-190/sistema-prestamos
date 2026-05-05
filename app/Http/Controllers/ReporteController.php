<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReporteController extends Controller
{
    public function index()
    {
        // Estadísticas generales
        $equipos_total = DB::table('equipos')->count();
        $equipos_disponibles = DB::table('equipos')->where('estado', 'Disponible')->count();
        $equipos_prestados = DB::table('equipos')->where('estado', 'Prestado')->count();
        $equipos_danados = DB::table('equipos')->where('estado', 'Dañado')->count();

        $prestamos_total = DB::table('prestamos')->count();
        $prestamos_activos = DB::table('prestamos')->where('estado', 'Prestado')->count();
        $prestamos_devueltos = DB::table('prestamos')->where('estado', 'Devuelto')->count();
        $prestamos_retrasados = DB::table('prestamos')->where('estado', 'Retrasado')->count();

        $alumnos_total = DB::table('alumnos')->count();

        // Historial completo de préstamos
        $historialPrestamos = DB::table('prestamos')
            ->join('equipos', 'prestamos.equipo_id', '=', 'equipos.id')
            ->join('alumnos', 'prestamos.alumno_id', '=', 'alumnos.id')
            ->select('prestamos.*', 'equipos.nombre as equipo_nombre', 'alumnos.nombre as alumno_nombre', 'alumnos.matricula')
            ->orderBy('prestamos.created_at', 'desc')
            ->get();

        // Inventario de equipos
        $inventarioEquipos = DB::table('equipos')
            ->select('tipo', DB::raw('count(*) as cantidad'), DB::raw('sum(case when estado = "Disponible" then 1 else 0 end) as disponibles'))
            ->groupBy('tipo')
            ->get();

        return view('reportes.index', compact(
            'equipos_total', 'equipos_disponibles', 'equipos_prestados', 'equipos_danados',
            'prestamos_total', 'prestamos_activos', 'prestamos_devueltos', 'prestamos_retrasados',
            'alumnos_total', 'historialPrestamos', 'inventarioEquipos'
        ));
    }
}

