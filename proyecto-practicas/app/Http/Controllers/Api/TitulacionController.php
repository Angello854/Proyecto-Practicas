<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Titulacion;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Titulaciones",
 *     description="Operaciones relacionadas con las titulaciones"
 * )
 */
class TitulacionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/titulaciones",
     *     summary="Listar todas las titulaciones",
     *     tags={"Titulaciones"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de titulaciones",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Titulacion"))
     *     )
     * )
     */
    public function index()
    {
        return Titulacion::all();
    }

    /**
     * @OA\Post(
     *     path="/api/titulaciones",
     *     summary="Crear una nueva titulación",
     *     tags={"Titulaciones"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre"},
     *             @OA\Property(property="nombre", type="string", example="Técnico Superior DAW")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Titulación creada exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Titulacion")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $titulacion = \App\Models\Titulacion::create([
            'nombre' => $request->input('nombre'),
        ]);

        return response()->json($titulacion, 201);
    }
}
