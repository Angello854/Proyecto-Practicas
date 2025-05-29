<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asignatura;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/asignaturas",
     *     summary="Listar todas las asignaturas",
     *     tags={"Asignaturas"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de asignaturas",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Asignatura"))
     *     )
     * )
     */
    public function index()
    {
        return Asignatura::all();
    }

    /**
     * @OA\Post(
     *     path="/api/asignaturas",
     *     summary="Crear una nueva asignatura",
     *     tags={"Asignaturas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre"},
     *             @OA\Property(property="nombre", type="string", example="Programación")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Asignatura creada correctamente",
     *         @OA\JsonContent(ref="#/components/schemas/Asignatura")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $asignatura = Asignatura::create([
            'nombre' => $request->input('nombre'),
        ]);

        return response()->json($asignatura, 201);
    }
}
