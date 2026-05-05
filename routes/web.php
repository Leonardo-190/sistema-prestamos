<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ConfiguracionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rutas de recurso para Equipos
    Route::resource('equipos', EquipoController::class);

    // Rutas de recurso para Alumnos
    Route::resource('alumnos', AlumnoController::class);

   // Rutas para Préstamos
       Route::get('/prestamos', [PrestamoController::class, 'index'])->name('prestamos.index');
       Route::get('/prestamos/create', [PrestamoController::class, 'create'])->name('prestamos.create');
       Route::post('/prestamos', [PrestamoController::class, 'store'])->name('prestamos.store');

       // Rutas faltantes que causan el error:
       Route::get('/prestamos/{id}/edit', [PrestamoController::class, 'edit'])->name('prestamos.edit');
       Route::put('/prestamos/{id}', [PrestamoController::class, 'update'])->name('prestamos.update');
       Route::delete('/prestamos/{id}', [PrestamoController::class, 'destroy'])->name('prestamos.destroy');

       // Ruta para el botón de devolución (Cambiado a POST para que funcione con tu <form>)
       Route::post('/prestamos/{id}/devolver', [PrestamoController::class, 'devolver'])->name('prestamos.devolver');

    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/configuracion', [ConfiguracionController::class, 'index'])->name('configuracion.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
