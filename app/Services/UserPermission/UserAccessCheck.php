<?php

namespace App\Services\UserPermission;

class UserAccessCheck
{
    use PermissionList;

    protected array $perms = [
        'home' => 'dashboard_view',
        'clients' => 'client_view',
        'add-client' => 'client_add',
        'projects' => 'project_view',
        'timesheet' => 'timesheet_view',
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
