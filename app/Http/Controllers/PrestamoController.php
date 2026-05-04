<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
    public function index()
    {
        $prestamos = DB::table('prestamos')->get();
        return view('prestamos.index', compact('prestamos'));
    }
}

