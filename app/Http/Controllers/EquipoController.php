<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipoController extends Controller
{
    public function index()
    {

        $equipos = DB::table('equipos')->get();

        return view('equipos.index', compact('equipos'));
    }
}
