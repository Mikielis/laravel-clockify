<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class ProjectRepository implements ProjectRepositoryInterface
{
    use BaseRepository;

    /**
     * @param Project $model
     */
    public function __construct(
        protected Project $model
    ) {}

    /**
     * Add project
     * @param string $name
     * @param ?string $dateFrom
     * @param ?string $dateTo
     * @param ?string $deadline
     * @param int|null $devTimeLimit
     * @param string $clientId
     * @param ?string $trelloBoard
     * @param ?string $note
     * @return void
     */
    public function addProject(
        string $name,
        ?string $dateFrom,
        ?string $dateTo,
        ?string $deadline,
        ?int $devTimeLimit,
        string $clientId,
        ?string $trelloBoard,
        ?string $note,
    ): void {
        Project::create([
            'name' => $name,
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'deadline' => $deadline,
            'dev_time_limit' => $devTimeLimit,
            'client_id' => $clientId,
            'trello_board' => $trelloBoard,
            'note' => $note
        ]);
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
     * @param string|null $trelloBoard
     * @param string|null $note
     * @return void
     */
    public function saveProject(
        string $id,
        string $name,
        ?string $dateFrom,
        ?string $dateTo,
        ?string $deadline,
        ?int $devTimeLimit,
        string $clientId,
        ?string $trelloBoard,
        ?string $note,
    ): void {
        $project = Project::find($id);

        $project->name = $name;
        $project->date_from = $dateFrom;
        $project->date_to = $dateTo;
        $project->deadline = $deadline;
        $project->dev_time_limit = $devTimeLimit;
        $project->client_id = $clientId;
        $project->trello_board = $trelloBoard;
        $project->note = $note;

        $project->save();
    }

    /**
     * Get projects
     * @param bool|null $sortByName
     * @param bool|null $sortByClientName
     * @return SupportCollection|null
     */
    public function getProjects(?bool $sortByName = null, ?bool $sortByClientName = null): ?SupportCollection
    {
        $query = DB::table('projects')
            ->leftJoin('clients', 'clients.id', '=', 'projects.client_id')
            ->select(
                'projects.*',
                'clients.name as client_name',
                'clients.id as client_id',
                'clients.country as client_country',
            )
            ->whereNull('clients.deleted_at')
            ->whereNull('projects.deleted_at');

        // Sort by client name
        if (true == $sortByClientName) {
            $query->orderBy('client_name');
        }

        // Sort by project name
        if (true == $sortByName) {
            $query->orderBy('projects.name');
        }

        return $query->get();
    }

    /**
     * Disable project
     * @param string $id
     * @return void
     */
    public function disable(string $id): void
    {
        Project::find($id)->delete();
    }
}
