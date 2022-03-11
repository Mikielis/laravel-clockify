<?php

namespace App\Services\UserPermission;

class UserAccessCheck
{
    use PermissionList;

    /**
     * Pair route names with required permission type
     * @var array|string[]
     */
    protected array $perms = [
        'home' => 'dashboard_view',

        // Client
        'clients' => 'client_view',
        'add-client' => 'client_add',
        'edit-client' => 'client_edit',
        'save-client' => 'client_save',
        'disable-client' => 'client_disable',

        // Project
        'projects' => 'project_view',
        'add-project' => 'project_add',
        'edit-project' => 'project_edit',
        'save-project' => 'project_save',
        'disable-project' => 'project_disable',

        // Timesheet
        'timesheet' => 'timesheet_view',
        'add-timesheet' => 'timesheet_add',
        'edit-timesheet' => 'timesheet_edit',
        'save-timesheet' => 'timesheet_save',
        'disable-timesheet' => 'timesheet_disable',
    ];

    /**
     * Check if user can see current route
     * @param string $routeName
     * @return bool
     */
    public function can(string $routeName): bool
    {
        return isset($this->perms[$routeName]) && \Auth::user()->can($this->perms[$routeName]);
    }
}
