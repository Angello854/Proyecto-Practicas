<?php

namespace App\Http\Controllers;

use App\Services\GitHubService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class IssuesController extends Controller
{
    protected $githubService;

    public function __construct(GitHubService $githubService)
    {
        $this->githubService = $githubService;
    }

    /**
     * Mostrar todas las issues
     */
    public function index(Request $request)
    {
        try {
            $owner = config('github.repository.owner');
            $repo = config('github.repository.name');

            // Validar configuración
            if (!$owner || !$repo) {
                return back()->withError('Configuración de repositorio incompleta');
            }

            // Parámetros de filtrado
            $state = $request->get('state', 'open'); // open, closed, all
            $labels = $request->get('labels');
            $sort = $request->get('sort', 'created'); // created, updated, comments
            $direction = $request->get('direction', 'desc'); // asc, desc

            $issues = $this->githubService->getIssues($owner, $repo, [
                'state' => $state,
                'labels' => $labels,
                'sort' => $sort,
                'direction' => $direction,
                'per_page' => 20
            ]);

            // Obtener estadísticas adicionales
            $stats = $this->githubService->getRepositoryStats($owner, $repo);

            return view('issues.index', compact('issues', 'state', 'owner', 'repo', 'stats'));

        } catch (Exception $e) {
            Log::error('Error al obtener issues: ' . $e->getMessage());
            return back()->withError('Error al obtener las issues: ' . $e->getMessage());
        }
    }

    /**
     * Mostrar una issue específica
     */
    public function show($number)
    {
        try {
            $owner = config('github.repository.owner');
            $repo = config('github.repository.name');

            // Validar configuración
            if (!$owner || !$repo) {
                return back()->withError('Configuración de repositorio incompleta');
            }

            // Validar número de issue
            if (!is_numeric($number) || $number <= 0) {
                return redirect()->route('issues.index')->withError('Número de issue inválido');
            }

            $issue = $this->githubService->getIssue($owner, $repo, $number);
            $comments = $this->githubService->getIssueComments($owner, $repo, $number);

            return view('issues.show', compact('issue', 'comments', 'owner', 'repo'));

        } catch (Exception $e) {
            Log::error('Error al obtener issue: ' . $e->getMessage());

            // Si la issue no existe, redirigir con mensaje específico
            if (str_contains($e->getMessage(), '404')) {
                return redirect()->route('issues.index')->withError('Issue #' . $number . ' no encontrada');
            }

            return back()->withError('Error al obtener la issue: ' . $e->getMessage());
        }
    }

    /**
     * API endpoint para obtener issues como JSON
     */
    public function api(Request $request)
    {
        try {
            $owner = config('github.repository.owner');
            $repo = config('github.repository.name');

            if (!$owner || !$repo) {
                return response()->json([
                    'success' => false,
                    'error' => 'Configuración de repositorio incompleta'
                ], 400);
            }

            $state = $request->get('state', 'open');
            $perPage = min($request->get('per_page', 10), 100); // Máximo 100

            $issues = $this->githubService->getIssues($owner, $repo, [
                'state' => $state,
                'per_page' => $perPage,
                'sort' => $request->get('sort', 'created'),
                'direction' => $request->get('direction', 'desc')
            ]);

            return response()->json([
                'success' => true,
                'data' => $issues,
                'count' => count($issues),
                'repository' => [
                    'owner' => $owner,
                    'name' => $repo
                ]
            ]);

        } catch (Exception $e) {
            Log::error('Error en API de issues: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener estadísticas del repositorio
     */
    public function stats()
    {
        try {
            $owner = config('github.repository.owner');
            $repo = config('github.repository.name');

            if (!$owner || !$repo) {
                return response()->json([
                    'success' => false,
                    'error' => 'Configuración de repositorio incompleta'
                ], 400);
            }

            $stats = $this->githubService->getRepositoryStats($owner, $repo);

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);

        } catch (Exception $e) {
            Log::error('Error al obtener estadísticas: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
