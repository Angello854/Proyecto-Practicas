<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Cursos",
 *     description="Operaciones relacionadas con los cursos"
 * )
 */
class CursoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/cursos",
     *     summary="Listar todos los cursos",
     *     tags={"Cursos"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de cursos",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Curso"))
     *     )
     * )
     */
    public function index()
    {
        return Curso::all();
    }

    /**
     * @OA\Post(
     *     path="/api/cursos",
     *     summary="Crear un nuevo curso",
     *     tags={"Cursos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre"},
     *             @OA\Property(property="nombre", type="string", example="1º DAW")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Curso creado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Curso")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $curso = Curso::create([
            'nombre' => $request->input('nombre'),
        ]);

        return response()->json($curso, 201);
    }
}

