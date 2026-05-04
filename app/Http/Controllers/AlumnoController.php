<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    public function index()
    {
        $alumnos = DB::table('alumnos')->get();
        return view('alumnos.index', compact('alumnos'));
    }
}

