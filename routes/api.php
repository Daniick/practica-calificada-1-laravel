<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('alumno', [AlumnoController::class]);
Route::resource('curso', [CursoController::class]);
Route::resource('docente', [DocenteController::class]);

Route::post('/alumnos/{alumnoId}/cursos/{cursoId}/enroll', [AlumnoController::class, 'enrollInCourse']);
Route::get('/alumnos/{alumnoId}/cursos/{cursoId}/enrollment', [AlumnoController::class, 'showEnrollment']);

Route::get('/asistencias', [AsistenciaController::class, 'index']);
Route::post('/asistencias', [AsistenciaController::class, 'store']);
