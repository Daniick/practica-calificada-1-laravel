<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="API simulador de escuela",
 *     description="Api donde podras ver, editar, crear y eliminar los datos de los estudiantes, profesores y materias, asi como tambien matricular un alumno a una materia.",
 *     version="1.0.0",
 *     @OA\Contact(
 *         email="arturo@arturo.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     ),
 *     @OA\Server(url="http://127.0.0.1:8000")
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
