<?php

namespace App\Services\UserPermission;

trait PermissionList
{
    /**
     * list of base permissions
     */
    public array $basePermissionsList = [
        'dashboard_view',
        'client_view',
        'client_add',
        'client_edit',
        'project_view',
        'project_add',
        'project_edit',
        'timesheet_view',
        'timesheet_add',
        'timesheet_edit',
        'report_view',
    ];

    /**
     * List of admin permissions
     */
    public array $adminPermissionsList = [
        'user_view'
    ];
}
