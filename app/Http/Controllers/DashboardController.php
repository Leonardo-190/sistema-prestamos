<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Contadores generales
        $totalEquipos = DB::table('equipos')->count();
        $equiposDisponibles = DB::table('equipos')->where('estado', 'Disponible')->count();
        $equiposPrestados = DB::table('equipos')->where('estado', 'Prestado')->count();
        $equiposDanados = DB::table('equipos')->where('estado', 'Dañado')->count();

        // Préstamos
        $prestamosActivos = DB::table('prestamos')->where('estado', 'Prestado')->count();
        $prestamosRetrasados = DB::table('prestamos')->where('estado', 'Retrasado')->count();
        $prestamosTotales = DB::table('prestamos')->count();

        // Alumnos
        $alumnosTotales = DB::table('alumnos')->count();

        // Datos para gráficas
        // Gráfica 1: Distribución de equipos por tipo
        $equiposPorTipo = DB::table('equipos')
            ->select('tipo', DB::raw('count(*) as cantidad'))
            ->groupBy('tipo')
            ->get();

        // Gráfica 2: Préstamos últimos 7 días
        $hace7dias = Carbon::now()->subDays(7);
        $prestamosUltimaSemana = DB::table('prestamos')
            ->select(DB::raw('DATE(fecha_prestamo) as fecha'), DB::raw('count(*) as cantidad'))
            ->where('fecha_prestamo', '>=', $hace7dias)
            ->groupBy(DB::raw('DATE(fecha_prestamo)'))
            ->orderBy('fecha')
            ->get();

        // Préstamos recientes
        $prestamosRecientes = DB::table('prestamos')
            ->join('equipos', 'prestamos.equipo_id', '=', 'equipos.id')
            ->join('alumnos', 'prestamos.alumno_id', '=', 'alumnos.id')
            ->select('prestamos.id', 'equipos.nombre as equipo_nombre', 'alumnos.nombre as alumno_nombre',
                     'prestamos.fecha_prestamo', 'prestamos.fecha_devolucion', 'prestamos.estado')
            ->orderBy('prestamos.created_at', 'desc')
            ->limit(5)
            ->get();

        // Equipos en mantenimiento
        $equiposDanados_list = DB::table('equipos')
            ->where('estado', 'Dañado')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalEquipos', 'equiposDisponibles', 'equiposPrestados', 'equiposDanados',
            'prestamosActivos', 'prestamosRetrasados', 'prestamosTotales', 'alumnosTotales',
            'equiposPorTipo', 'prestamosUltimaSemana', 'prestamosRecientes', 'equiposDanados_list'
        ));
    }
}

