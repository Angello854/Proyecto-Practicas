<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Empresas",
 *     description="Operaciones relacionadas con las empresas"
 * )
 */
class EmpresaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/empresas",
     *     summary="Listar todas las empresas",
     *     tags={"Empresas"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de empresas",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Empresa"))
     *     )
     * )
     */
    public function index()
    {
        return Empresa::all();
    }

    /**
     * @OA\Post(
     *     path="/api/empresas",
     *     summary="Crear una nueva empresa",
     *     tags={"Empresas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre"},
     *             @OA\Property(property="nombre", type="string", example="Diputación de Málaga"),
     *             @OA\Property(property="tutor_laboral_id", type="integer", nullable=true, example=37)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Empresa creada exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Empresa")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $empresa = Empresa::create([
            'nombre' => $request->input('nombre'),
            'tutor_laboral_id' => $request->input('tutor_laboral_id'),
        ]);

        return response()->json($empresa, 201);
    }
}

