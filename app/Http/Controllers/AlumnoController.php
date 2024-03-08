<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Curso;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Listado de todos los registros de los alumnos
     * @OA\Get (
     *     path="/api/alumno",
     *     tags={"Alumnos"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="nombre",
     *                         type="string",
     *                         example="Anderson"
     *                     ),
     *                     @OA\Property(
     *                         property="apellido",
     *                         type="string",
     *                         example="Lazaro"
     *                     ),
     *                     @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="anderson@lazaro.xyz"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2023-02-23T00:09:16.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2023-02-23T12:33:45.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function index()
    {
        $alumnos = Alumno::all();
        return response()->json($alumnos);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Registrar la información de un Alumno
     * @OA\Post (
     *     path="/api/alumno",
     *     tags={"Alumnos"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="nombre",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="apellido",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "nombre":"Anderson",
     *                     "apellido":"Lazaro",
     *                     "email":"anderson@lazaro.xyz"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="CREATED",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="nombre", type="string", example="Anderson"),
     *              @OA\Property(property="apellido", type="string", example="Lazaro"),
     *              @OA\Property(property="email", type="string", example="anderson@lazaro.xyz"),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="UNPROCESSABLE CONTENT",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The apellidos field is required."),
     *              @OA\Property(property="errors", type="string", example="Objeto de errores"),
     *          )
     *      )
     * )
     */

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:alumnos',
        ]);

        $alumno = Alumno::create($request->all());
        return response()->json($alumno, 201);
    }

    /**
     * Display the specified resource.
     */

    /**
     * Mostrar la información de un alumno
     * @OA\Get (
     *     path="/api/alumno/{id}",
     *     tags={"Alumnos"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="nombre", type="string", example="Anderson"),
     *              @OA\Property(property="apellido", type="string", example="Lazaro"),
     *              @OA\Property(property="email", type="string", example="anderson@lazaro.xyz"),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Alumno] #id"),
     *          )
     *      )
     * )
     */

    public function show(string $id)
    {
        $alumno = Alumno::findOrFail($id);
        return response()->json($alumno);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Actualizar la información de un Alumno
     * @OA\Put (
     *     path="/api/alumno/{id}",
     *     tags={"Alumnos"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="nombre",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="apellido",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "nombre":"Anderson",
     *                     "apellido":"Lazaro",
     *                     "email":"anderson@lazaro.xyz"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="nombre", type="string", example="Anderson"),
     *              @OA\Property(property="apellido", type="string", example="Lazaro"),
     *              @OA\Property(property="email", type="string", example="anderson@lazaro.xyz"),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="UNPROCESSABLE CONTENT",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The apellidos field is required."),
     *              @OA\Property(property="errors", type="string", example="Objeto de errores"),
     *          )
     *      )
     * )
     */

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:alumnos,email,' . $id,
        ]);

        $alumno = Alumno::findOrFail($id);
        $alumno->update($request->all());
        return response()->json($alumno);
    }

    /**
     * Remove the specified resource from storage.
     */

    /**
     * Eliminar la información de un cliente
     * @OA\Delete (
     *     path="/api/alumno/{id}",
     *     tags={"Alumnos"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No se pudo realizar correctamente la operación"),
     *              @OA\Property(property="errors", type="string", example="Objeto de errores")
     *          )
     *      ),
     *     @OA\Response(
     *         response=204,
     *         description="NO CONTENT",
     *     )
     * )
     */


    public function destroy(string $id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->delete();
        return response()->json(null, 204);
    }

    /**
     * Matricular un alumno a un curso
     * @OA\Post (
     *     path="/api/alumnos/{alumnoId}/cursos/{cursoId}/enroll",
     *     tags={"Matriculas"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="alumno_id",
     *                          type="number"
     *                      ),
     *                      @OA\Property(
     *                          property="curso_id",
     *                          type="number"
     *                      )
     *                 ),
     *                 example={
     *                     "alumno_id":"2",
     *                     "curso_id":"1"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="CREATED",
     *          
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="UNPROCESSABLE CONTENT",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The curso_Id field is required."),
     *              @OA\Property(property="errors", type="string", example="Objeto de errores"),
     *          )
     *      )
     * )
     */
    
    public function enrollInCourse(Request $request, $alumnoId, $cursoId)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        $alumnoId = $request->input('alumno_id');
        $cursoId = $request->input('curso_id');

        $alumno = Alumno::findOrFail($alumnoId);
        $curso = Curso::findOrFail($cursoId);


        $alumno->cursos()->attach($curso);

        return response()->json(['message' => 'Student enrolled in course successfully'], 200);
    }


    /**
     * Verificar el curso que fue matriculado un alumno
     * @OA\Get (
     *     path="/api/alumnos/{alumnoId}/cursos/{cursoId}/enrollment",
     *     tags={"Matriculas"},
     *     @OA\Parameter(
     *         in="path",
     *         name="alumnoId",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="path",
     *         name="cursoId",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *        ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Alumno] with alumnoId and cursoId"),
     *          )
     *      )
     * )
     */

    public function showEnrollment($alumnoId, $cursoId)
    {
        // Find the student and the course
        $alumno = Alumno::findOrFail($alumnoId);
        $curso = Curso::findOrFail($cursoId);

        // Check if the student is enrolled in the course
        $isEnrolled = $alumno->cursos()->where('curso_id', $cursoId)->exists();

        // If enrolled, return details of student and course
        if ($isEnrolled) {
            return response()->json([
                'enrolled' => true,
                'alumno' => $alumno,
                'curso' => $curso
            ]);
        } else {
            return response()->json(['enrolled' => false]);
        }
    }

    
}
