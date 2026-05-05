<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Importar Carbon para la fecha de registro

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = DB::table('equipos')->get();
        return view('equipos.index', compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'estado' => 'required|string|in:Disponible,Prestado,Dañado',
        ]);

        DB::table('equipos')->insert([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'estado' => $request->estado,
            'fecha_registro' => Carbon::now(), // Usar Carbon para la fecha actual
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('equipos.index')->with('success', 'Equipo creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $equipo = DB::table('equipos')->where('id', $id)->first();

        if (!$equipo) {
            return redirect()->route('equipos.index')->with('error', 'Equipo no encontrado.');
        }

        return view('equipos.edit', compact('equipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'estado' => 'required|string|in:Disponible,Prestado,Dañado',
        ]);

        DB::table('equipos')->where('id', $id)->update([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'estado' => $request->estado,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('equipos.index')->with('success', 'Equipo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('equipos')->where('id', $id)->delete();

        return redirect()->route('equipos.index')->with('success', 'Equipo eliminado exitosamente.');
    }
}
