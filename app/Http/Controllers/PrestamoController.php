<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PrestamoController extends Controller
{
    public function index()
    {
        $prestamos = DB::table('prestamos')
            ->join('equipos', 'prestamos.equipo_id', '=', 'equipos.id')
            ->join('alumnos', 'prestamos.alumno_id', '=', 'alumnos.id')
            ->select('prestamos.*', 'equipos.nombre as equipo_nombre', 'alumnos.nombre as alumno_nombre', 'alumnos.matricula')
            ->orderBy('prestamos.created_at', 'desc')
            ->get();

        return view('prestamos.index', compact('prestamos'));
    }

    public function create()
    {
        $equipos = DB::table('equipos')->where('estado', 'Disponible')->get();
        $alumnos = DB::table('alumnos')->get();

        return view('prestamos.create', compact('equipos', 'alumnos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'alumno_id' => 'required|exists:alumnos,id',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion_estimada' => 'required|date|after:fecha_prestamo',
        ]);

        // Verificar que el equipo está disponible
        $equipo = DB::table('equipos')->where('id', $request->equipo_id)->first();
        if (!$equipo || $equipo->estado !== 'Disponible') {
            return redirect()->back()->with('error', 'El equipo no está disponible.');
        }

        // Crear préstamo
        $prestamoId = DB::table('prestamos')->insertGetId([
            'equipo_id' => $request->equipo_id,
            'alumno_id' => $request->alumno_id,
            'fecha_prestamo' => $request->fecha_prestamo,
            'fecha_devolucion' => $request->fecha_devolucion_estimada,
            'estado' => 'Prestado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Cambiar estado del equipo a Prestado
        DB::table('equipos')->where('id', $request->equipo_id)->update([
            'estado' => 'Prestado',
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('prestamos.index')->with('success', 'Préstamo registrado exitosamente.');
    }

    public function edit(string $id)
    {
        $prestamo = DB::table('prestamos')->where('id', $id)->first();

        if (!$prestamo || $prestamo->estado !== 'Prestado') {
            return redirect()->route('prestamos.index')->with('error', 'No se puede editar este préstamo.');
        }

        $equipos = DB::table('equipos')->get();
        $alumnos = DB::table('alumnos')->get();

        return view('prestamos.edit', compact('prestamo', 'equipos', 'alumnos'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'alumno_id' => 'required|exists:alumnos,id',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion_estimada' => 'required|date|after:fecha_prestamo',
        ]);

        DB::table('prestamos')->where('id', $id)->update([
            'equipo_id' => $request->equipo_id,
            'alumno_id' => $request->alumno_id,
            'fecha_prestamo' => $request->fecha_prestamo,
            'fecha_devolucion' => $request->fecha_devolucion_estimada,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('prestamos.index')->with('success', 'Préstamo actualizado exitosamente.');
    }

    public function destroy(string $id)
    {
        $prestamo = DB::table('prestamos')->where('id', $id)->first();

        if (!$prestamo) {
            return redirect()->route('prestamos.index')->with('error', 'Préstamo no encontrado.');
        }

        if ($prestamo->estado === 'Prestado') {
            // Cambiar equipo de vuelta a disponible
            DB::table('equipos')->where('id', $prestamo->equipo_id)->update([
                'estado' => 'Disponible',
                'updated_at' => Carbon::now(),
            ]);
        }

        DB::table('prestamos')->where('id', $id)->delete();

        return redirect()->route('prestamos.index')->with('success', 'Préstamo eliminado exitosamente.');
    }

    /**
     * Botón de devolución - Funcionalidad crítica
     */
    public function devolver(string $id)
    {
        $prestamo = DB::table('prestamos')->where('id', $id)->first();

        if (!$prestamo) {
            return redirect()->route('prestamos.index')->with('error', 'Préstamo no encontrado.');
        }

        if ($prestamo->estado !== 'Prestado') {
            return redirect()->route('prestamos.index')->with('error', 'Este préstamo no está activo.');
        }

        // Actualizar préstamo a devuelto
        DB::table('prestamos')->where('id', $id)->update([
            'fecha_devolucion' => Carbon::now(),
            'estado' => 'Devuelto',
            'updated_at' => Carbon::now(),
        ]);

        // Cambiar equipo a disponible
        DB::table('equipos')->where('id', $prestamo->equipo_id)->update([
            'estado' => 'Disponible',
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('prestamos.index')->with('success', 'Equipo devuelto exitosamente.');
    }
}

