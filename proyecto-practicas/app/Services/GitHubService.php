<?php

namespace App\Services;

use GrahamCampbell\GitHub\Facades\GitHub;

class GitHubService
{
    /**
     * Obtener todas las issues de un repositorio
     */
    public function getIssues(string $owner, string $repo, array $params = [])
    {
        return GitHub::issues()->all($owner, $repo, $params);
    }

    /**
     * Obtener una issue específica
     */
    public function getIssue(string $owner, string $repo, int $number)
    {
        return GitHub::issues()->show($owner, $repo, $number);
    }

    /**
     * Obtener comentarios de una issue
     */
    public function getIssueComments(string $owner, string $repo, int $number)
    {
        return GitHub::issues()->comments()->all($owner, $repo, $number);
    }

    /**
     * Obtener estadísticas del repositorio
     */
    public function getRepositoryStats(string $owner, string $repo)
    {
        $repository = GitHub::repository()->show($owner, $repo);
        $openIssues = $this->getIssues($owner, $repo, ['state' => 'open']);
        $closedIssues = $this->getIssues($owner, $repo, ['state' => 'closed']);

        return [
            'repository' => $repository,
            'open_issues' => count($openIssues),
            'closed_issues' => count($closedIssues),
            'total_issues' => count($openIssues) + count($closedIssues),
        ];
    }

    /**
     * Obtener labels del repositorio
     */
    public function getLabels(string $owner, string $repo)
    {
        return GitHub::issues()->labels()->all($owner, $repo);
    }
}
