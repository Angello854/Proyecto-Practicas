<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Creador;
use Illuminate\Http\Request;

class CreadorController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/creadores",
     *     summary="Listar todos los creadores",
     *     tags={"Creadores"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de creadores",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Creador"))
     *     )
     * )
     */
    public function index()
    {
        return Creador::all();
    }

    /**
     * @OA\Post(
     *     path="/api/creadores",
     *     summary="Crear un nuevo creador",
     *     tags={"Creadores"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre"},
     *             @OA\Property(property="nombre", type="string", example="ZedoX")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Creador creado correctamente",
     *         @OA\JsonContent(ref="#/components/schemas/Creador")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $asignatura = Creador::create([
            'nombre' => $request->input('nombre'),
        ]);

        return response()->json($asignatura, 201);
    }
}
