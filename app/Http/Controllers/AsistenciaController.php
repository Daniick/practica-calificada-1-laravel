<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;



class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Listado de todos los registros de los alumnos
     * @OA\Get (
     *     path="/api/asistencias",
     *     tags={"Asistencias"},
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
     *                         property="alumno_id",
     *                         type="string",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="fecha",
     *                         type="string",
     *                         example="2024/01/25"
     *                     ),
     *                     @OA\Property(
     *                         property="asistencia",
     *                         type="string",
     *                         example="A"
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
        $asistencia = Asistencia::all();
        return response()->json($asistencia);
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
     * Registrar la asistencia de un alumno
     * @OA\Post (
     *     path="/api/asistencias",
     *     tags={"Asistencias"},
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
     *                          property="fecha",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="asistencia",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "alumno_id":"1",
     *                     "fecha":"2024/02/24",
     *                     "asistencia":"A"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="CREATED",
     *          @OA\JsonContent(
     *              @OA\Property(property="alumno_id", type="number", example=1),
     *              @OA\Property(property="fecha", type="string", example="2024/02/24"),
     *              @OA\Property(property="asistencia", type="string", example="A"),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="UNPROCESSABLE CONTENT",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The asistencias field is required."),
     *              @OA\Property(property="errors", type="string", example="Objeto de errores"),
     *          )
     *      )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'fecha' => 'required|date',
            'asistencia' => 'required|in:A,T,F',
        ]);

        // Crea un nuevo registro de asistencia
        $asistencia = Asistencia::create([
            'alumno_id' => $request->alumno_id,
            'fecha' => $request->fecha,
            'asistencia' => $request->asistencia,
        ]);

        // Devuelve una respuesta
        return response()->json(['message' => 'Asistencia registrada correctamente', 'data' => $asistencia], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function registrarAsistencia(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'fecha' => 'required|date',
            'asistencia' => 'required|in:A,T,F', // Validar que la opción de asistencia sea una de las permitidas
        ]);

        $asistencia = new Asistencia();
        $asistencia->alumno_id = $request->alumno_id;
        $asistencia->fecha = $request->fecha;
        $asistencia->asistencia = $request->asistencia;
        $asistencia->save();

        return response()->json(['message' => 'Asistencia registrada correctamente'], 200);
    }
}
