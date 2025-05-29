<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Incidencia;
use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/incidencias",
     *     summary="Listar todas las incidencias",
     *     tags={"Incidencias"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de incidencias",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Incidencia"))
     *     )
     * )
     */
    public function index()
    {
        return Incidencia::all();
    }

    /**
     * @OA\Post(
     *     path="/api/incidencias",
     *     summary="Crear una nueva incidencia",
     *     tags={"Incidencias"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"titulo", "usuario_id", "contenido"},
     *             @OA\Property(property="titulo", type="string", example="Adiós"),
     *             @OA\Property(property="usuario_id", type="integer", example=1),
     *             @OA\Property(
     *                 property="contenido",
     *                 type="string",
     *                 format="html",
     *                 example="<p><strong><em>Adiós</em></strong><br></p>"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Incidencia creada correctamente",
     *         @OA\JsonContent(ref="#/components/schemas/Incidencia")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $incidencia = Incidencia::create([
            'titulo' => $request->input('titulo'),
            'usuario_id' => $request->input('usuario_id'),
            'contenido' => $request->input('contenido'),
        ]);

        return response()->json($incidencia, 201);
    }
}
