<?php

namespace App\Filament\Pages;

use App\Enums\Rol;
use App\Services\GitHubService;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Exception;

class GitHubIssues extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-bug-ant';
    protected static string $view = 'filament.pages.git-hub-issues';
    protected static ?string $navigationGroup = 'GitHub';
    protected static ?string $title = 'GitHub Issues';
    protected static ?int $navigationSort = 10;

    public $issues = [];
    public $stats = [];
    public $isLoading = true;
    public $error = null;

    public static function canAccess(): bool
    {
        return auth()->check() && getUserRol() === Rol::Admin;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('refresh')
                ->label('Actualizar')
                ->icon('heroicon-m-arrow-path')
                ->action('loadIssues'),
            Action::make('viewAllIssues')
                ->label('Ver Todas las Issues')
                ->icon('heroicon-m-list-bullet')
                ->url(route('issues.index'))
                ->openUrlInNewTab(false),
            Action::make('viewOnGitHub')
                ->label('Ver en GitHub')
                ->icon('heroicon-m-arrow-top-right-on-square')
                ->url('https://github.com/' . config('github.repository.owner') . '/' . config('github.repository.name'))
                ->openUrlInNewTab(),
        ];
    }

    public function mount(): void
    {
        $this->loadIssues();
    }

    public function loadIssues(): void
    {
        try {
            $this->isLoading = true;
            $this->error = null;

            $githubService = app(GitHubService::class);
            $owner = config('github.repository.owner');
            $repo = config('github.repository.name');

            if (!$owner || !$repo) {
                throw new Exception('Configuración de repositorio incompleta');
            }

            // Obtener issues abiertas (solo las primeras 10 para el dashboard)
            $this->issues = $githubService->getIssues($owner, $repo, [
                'state' => 'open',
                'per_page' => 10,
                'sort' => 'created',
                'direction' => 'desc'
            ]);

            // Obtener estadísticas
            $this->stats = $githubService->getRepositoryStats($owner, $repo);

            $this->isLoading = false;

        } catch (Exception $e) {
            $this->error = 'Error al cargar las issues: ' . $e->getMessage();
            $this->isLoading = false;
            $this->issues = [];
            $this->stats = [];
        }
    }

    public function viewAllIssues(): void
    {
        $this->redirect(route('issues.index'));
    }

    public function viewIssue($number): void
    {
        $this->redirect(route('issues.show', $number));
    }
}
