<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plugin;
use Illuminate\Http\Request;

class PluginController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/plugins",
     *     summary="Listar todos los plugins",
     *     tags={"Plugins"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de plugins",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Plugin"))
     *     )
     * )
     */
    public function index()
    {
        return Plugin::all();
    }

    /**
     * @OA\Post(
     *     path="/api/plugins",
     *     summary="Crear un nuevo plugin",
     *     tags={"Plugins"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "creador_id"},
     *             @OA\Property(property="nombre", type="string", example="Logger"),
     *             @OA\Property(property="creador_id", type="integer", example=1),
     *             @OA\Property(property="descripcion", type="string", example="Plugin para registrar eventos."),
     *             @OA\Property(property="entorno", type="string", example="filament")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Plugin creado correctamente",
     *         @OA\JsonContent(ref="#/components/schemas/Plugin")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $plugin = Plugin::create([
            'nombre' => $request->input('nombre'),
            'creador_id' => $request->input('creador_id'),
        ]);

        return response()->json($plugin, 201);
    }
}
