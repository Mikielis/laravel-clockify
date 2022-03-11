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
        'client_disable',
        'project_view',
        'project_add',
        'project_edit',
        'project_disable',
        'timesheet_view',
        'timesheet_add',
        'timesheet_edit',
        'timesheet_disable',
        'report_view',
    ];

    /**
     * List of admin permissions
     */
    public array $adminPermissionsList = [
        'user_view'
    ];
}
