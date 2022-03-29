<?php

namespace App\Services\Project;

use App\Events\Project\Add as AddProjectEvent;
use App\Events\Project\Disable as DisableProjectEvent;
use App\Events\Project\Edit as EditProjectEvent;
use App\Events\Project\Save as SaveProjectEvent;
use App\Models\Project;
use App\Repositories\ClientRepositoryInterface;
use App\Repositories\ProjectRepositoryInterface;
use App\Services\Client\Country;
use App\Services\UserActivity\UserActivityService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use function abort;


class ProjectService
{
    use Country;

    public static array $messages = [
        'project added' => 'The project has been added',
        'project saved' => 'The project details have been saved',
        'project disabled' => 'The project has been disabled',
        'error' => 'Something went wrong',
    ];

    public function __construct(
        protected UserActivityService $userActivityService,
        protected ClientRepositoryInterface $clientRepository,
        protected ProjectRepositoryInterface $projectRepository
    ) {}

    /**
     * Add project
     * @param string $name
     * @param string|null $dateFrom
     * @param string|null $dateTo
     * @param string|null $deadline
     * @param int|null $devTimeLimit
     * @param string $clientId
     * @param string|null $trelloBoard
     * @param string|null $note
     * @return void
     */
    public function addProject(
        string $name,
        string|null $dateFrom,
        string|null $dateTo,
        string|null $deadline,
        int|null $devTimeLimit,
        string $clientId,
        string|null $trelloBoard,
        string|null $note,
    ): void
    {
        // Add new project
        $this->projectRepository->addProject(
            $name,
            $dateFrom,
            $dateTo,
            $deadline,
            $devTimeLimit,
            $clientId,
            $trelloBoard,
            $note
        );

        // Trigger event
        AddProjectEvent::dispatch();
    }

    /**
     * Save project
     * @param string $id
     * @param string $name
     * @param string|null $dateFrom
     * @param string|null $dateTo
     * @param string|null $deadline
     * @param int|null $devTimeLimit
     * @param string $clientId
     * @return void
     */
    public function saveProject(
        string $id,
        string $name,
        string|null $dateFrom,
        string|null $dateTo,
        string|null $deadline,
        int|null $devTimeLimit,
        string $clientId,
        string|null $trelloBoard,
        string|null $note
    ): void
    {
        $project = $this->projectRepository->find($id);

        // Project not found
        if (!$project) {
            Log::info(Auth::user()->name . ' has tried to save non-existing project with ID: ' . $id);
            abort(404);
        }

        // Save project
        $this->projectRepository->saveProject(
            $id,
            $name,
            $dateFrom,
            $dateTo,
            $deadline,
            $devTimeLimit,
            $clientId,
            $trelloBoard,
            $note
        );

        // Trigger event
        SaveProjectEvent::dispatch();
    }

    /**
     * Disable project
     * @param string $id
     * @return void
     */
    public function disable(string $id): void
    {
        // Find project
        $project = $this->projectRepository->find($id);

        // Project not found
        if (!$project) {
            Log::info(Auth::user()->name . ' has tried to disable non-existing project with ID: ' . $id);
            abort(404);
        }

        // Disable project and trigger event
        $this->projectRepository->disable($project->id);
        DisableProjectEvent::dispatch();
    }

    /**
     * Get project
     * @param string $id
     * @return Project|null
     */
    public function getProject(string $id): ?Project
    {
        $project = $this->projectRepository->find($id);

        // Project not found
        if (!$project) {
            Log::info(Auth::user()->name . ' has tried to edit non-existing project with ID: ' . $id);
            abort(404);
        }

        EditProjectEvent::dispatch();

        return $project;
    }

    /**
     * Get projects
     * @param bool|null $orderByClientName
     * @return SupportCollection|null
     */
    public function getProjects(?bool $orderByClientName = null): ?SupportCollection
    {
        return $this->projectRepository->getProjects(true, $orderByClientName);
    }

    /**
     * Get projects grouped by client
     * @return array
     */
    public function getProjectsGroupedByClient(): array
    {
        $projects = $this->getProjects(true);
        $groupedProjects = [];

        if (count($projects) > 0) {
            foreach ($projects as $key => $project) {
                $groupedProjects[$project->client_id][] = $projects[$key];
            }
        }

        return $groupedProjects;
    }
}
