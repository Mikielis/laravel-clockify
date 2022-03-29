<?php

namespace Tests\Unit;

use App\Services\UserPermission\PermissionList;
use PHPUnit\Framework\TestCase;

class UserPermissionsTest extends TestCase
{
    use PermissionList;

    /**
     * Test base permissions list
     * @return void
     */
    public function test_base_permissions_list_exists()
    {
        $this->assertIsArray($this->basePermissionsList);
        $this->assertNotEmpty($this->basePermissionsList);
    }

    /**
     * Test admin permissions list
     * @return void
     */
    public function test_admin_permissions_list_exists()
    {
        $this->assertIsArray($this->adminPermissionsList);
        $this->assertNotEmpty($this->adminPermissionsList);
    }
}
