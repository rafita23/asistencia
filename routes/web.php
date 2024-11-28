<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\MienbroController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
// Ruta principal con autenticación
Route::get('/', function () {
    return view('index');
})->middleware('auth');

// Rutas de Asistencias
Route::get('/asistencias/show', [AsistenciaController::class, 'show'])->name('asistencias.show');

Route::get('/asistencias', [AsistenciaController::class, 'index'])->name('asistencias.index');
Route::get('/asistencias/estudiantes/{grado_id}', [AsistenciaController::class, 'getEstudiantesPorGrado'])->name('asistencias.estudiantes');
Route::post('/asistencias', [AsistenciaController::class, 'store'])->name('asistencias.store');
Route::get('/asistencias/grados/{gradoId}/{fecha}', [AsistenciaController::class, 'getAsistenciasPorFechaYGrado'])->name('asistencias.filtro');

// Autenticación (Auth)
Auth::routes(['register' => false]);

// Ruta para Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Recursos para Mienbros y Grados
Route::resource('mienbros', MienbroController::class);
Route::resource('grados', GradoController::class);


//para ususario rafa es users
Route::resource('users', UserController::class);
Route::resource('users', UserController::class);

