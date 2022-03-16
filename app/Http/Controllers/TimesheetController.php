<?php

namespace App\Http\Controllers;

use App\Services\Project\ProjectService;
use App\Services\Timesheet\TimesheetService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function __construct(
        protected TimesheetService $timesheetService,
        protected ProjectService $projectService
    ) {
        view()->share('nav', 'timesheet');
    }

    public function index()
    {
        $devHours = $this->timesheetService->getUserRecords(Auth::user()->id);
        $projects = $this->projectService->getProjects();

        return view('timesheet.index', [
            'devHours' => $devHours,
            'projects' => $projects,
            'devHoursNumber' => count($devHours),
            'breadcrumb' => [
                ['name' => _('Timesheet')]
            ]
        ]);
    }
}
