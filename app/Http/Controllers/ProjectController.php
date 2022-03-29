<?php

namespace App\Http\Controllers;

use App\Services\Client\ClientService;
use App\Services\Project\ProjectService;
use App\Services\Project\FormValidation;
use App\Events\Project\SendForm;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    use FormValidation;

    public function __construct(
        protected ClientService $clientService,
        protected ProjectService $projectService
    ) {
        view()->share('nav', 'project');
    }

    public function index()
    {
        $clients = $this->clientService->getClients();
        $projects = $this->projectService->getProjects();
        $users = $this->projectService->getUsers();

        return view('project.index', [
            'clients' => $clients,
            'projects' => $projects,
            'projectsNumber' => count($projects),
            'users' => $users,
            'breadcrumb' => [
                ['name' => _('Projects')]
            ]
        ]);
    }

    /**
     * Add project
     * @param Request $request
     * @return RedirectResponse
     */
    public function add(Request $request)
    {
        SendForm::dispatch($request->input());

        // Validate request
        $request->validate($this->getFormValidationRules());

        // Add project
        $this->projectService->addProject(
            $request->input('name'),
            $request->input('date_from'),
            $request->input('date_to'),
            $request->input('deadline'),
            $request->input('dev_time_limit'),
            $request->input('client_id'),
            $request->input('trello_board'),
            $request->input('note'),
        );

        // Redirect with success message
        return redirect()->back()->with('success', $this->projectService::$messages['project added']);
    }

    /**
     * Edit project
     * @param Request $request
     * @return void
     */
    public function edit(Request $request)
    {
        $clients = $this->clientService->getClients();
        $project = $this->projectService->getProject($request->id);

        return view('project.edit', [
            'project' => $project,
            'clients' => $clients,
            'breadcrumb' => [
                ['name' => _('Projects'), 'url' => route('projects')],
                ['name' => _('Edit: ' . $project->name)]
            ]
        ]);
    }

    /**
     * Save project
     * @param Request $request
     * @return RedirectResponse
     */
    public function save(Request $request)
    {
        // Validate request
        $request->validate($this->getFormValidationRules());

        $this->projectService->saveProject(
            $request->id,
            $request->input('name'),
            $request->input('date_from'),
            $request->input('date_to'),
            $request->input('deadline'),
            $request->input('dev_time_limit'),
            $request->input('client_id'),
            $request->input('trello_board'),
            $request->input('note'),
        );

        // Redirect with success message
        return redirect()->back()->with('success', $this->projectService::$messages['project saved']);
    }

    /**
     * Disable project
     * @param Request $request
     * @return RedirectResponse
     */
    public function disable(Request $request): RedirectResponse
    {
        $this->projectService->disable($request->id);

        // Redirect with success message
        return redirect()->back()->with('success', $this->projectService::$messages['project disabled']);
    }

    /**
     * @return array
     */
    public function getFormValidationRules(): array
    {
        return $this->formValidationRules;
    }
}
