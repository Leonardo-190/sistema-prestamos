<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Importar Carbon para las fechas

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = DB::table('alumnos')->get();
        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'matricula' => 'required|string|max:255|unique:alumnos,matricula',
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'carrera' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:alumnos,correo',
            'telefono' => 'nullable|string|max:20',
        ]);

        DB::table('alumnos')->insert([
            'matricula' => $request->matricula,
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'carrera' => $request->carrera,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('alumnos.index')->with('success', 'Alumno registrado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alumno = DB::table('alumnos')->where('id', $id)->first();

        if (!$alumno) {
            return redirect()->route('alumnos.index')->with('error', 'Alumno no encontrado.');
        }

        return view('alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'matricula' => 'required|string|max:255|unique:alumnos,matricula,' . $id, // Ignorar la matrícula actual al actualizar
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'carrera' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:alumnos,correo,' . $id, // Ignorar el correo actual al actualizar
            'telefono' => 'nullable|string|max:20',
        ]);

        DB::table('alumnos')->where('id', $id)->update([
            'matricula' => $request->matricula,
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'carrera' => $request->carrera,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('alumnos')->where('id', $id)->delete();

        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado exitosamente.');
    }
}
