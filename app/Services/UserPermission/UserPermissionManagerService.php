<?php

namespace App\Services\UserPermission;

use App\Repositories\UserRepositoryInterface;
use Auth;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Models\Permission;
use function app;
use function report;

class UserPermissionManagerService
{
    use PermissionList;

    /**
     * @param UserRepositoryInterface $userRepository
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
        // Clear cache
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }

    /**
     * Set user permissions
     * @param int $userId
     * @return void
     */
    public function setUserPermissions(int $userId): void
    {
        // Add permissions of they do not exist
        $this->addPermissions($this->basePermissionsList);

        // Assign permissions to user
        $user = $this->userRepository->find($userId);

        if (!$user->hasPermissionTo($this->basePermissionsList[0])) {
            $user->givePermissionTo($this->basePermissionsList);
        }

    }

    /**
     * Set admin permissions
     * @param int $userId
     * @return void
     */
    public function setAdminPermissions(int $userId): void
    {
        // Add permissions of they do not exist
        $this->addPermissions($this->adminPermissionsList);

        // Assign permissions to user
        $user = $this->userRepository->find($userId);

        // Copy user permissions
        $this->setUserPermissions($userId);

        // Add admin permissions
        if (!$user->hasPermissionTo($this->adminPermissionsList[0])) {
            $user->givePermissionTo($this->adminPermissionsList);
        }
    }

    /**
     * Add non-existing list of permissions to storage
     * @param array $permissions
     * @return void
     */
    private function addPermissions(array $permissions): void
    {
        // Do not try to add permissions when first on the list is already in storage
        if (!Permission::getPermission(['name' => $permissions[0]])) {
            foreach ($permissions as $permission) {
                try {
                    Permission::create(['name' => $permission]);
                } catch (PermissionAlreadyExists $e) {
                    report($e->getMessage());
                }
            }
        }
    }
}
