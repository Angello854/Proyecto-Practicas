<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tarea;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Tareas",
 *     description="Operaciones relacionadas con las tareas"
 * )
 */
class TareaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tareas",
     *     summary="Listar todas las tareas",
     *     tags={"Tareas"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de tareas",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Tarea"))
     *     )
     * )
     */
    public function index()
    {
        return Tarea::all();
    }

    /**
     * @OA\Post(
     *     path="/api/tareas",
     *     summary="Crear una nueva tarea",
     *     tags={"Tareas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"descripcion", "fecha", "horas", "materiales"},
     *             @OA\Property(property="descripcion", type="string", example="Redactar informe"),
     *             @OA\Property(property="fecha", type="string", format="date", example="2025-05-30"),
     *             @OA\Property(property="horas", type="integer", example=3),
     *             @OA\Property(property="materiales", type="string", example="PC portátil")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tarea creada exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Tarea")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $tarea = Tarea::create([
            'descripcion' => $request->input('descripcion'),
            'fecha' => $request->input('fecha'),
            'horas' => $request->input('horas'),
            'materiales' => $request->input('materiales'),
        ]);

        return response()->json($tarea, 201);
    }
}

