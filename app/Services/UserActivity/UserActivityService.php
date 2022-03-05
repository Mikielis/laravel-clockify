<?php

namespace App\Services\UserActivity;

use App\Repositories\UserActivityRepositoryInterface;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class UserActivityService
{
    /**
     * @param UserActivityRepositoryInterface $userActivityRepository
     */
    public function __construct(
        protected UserActivityRepositoryInterface $userActivityRepository
    ) {}


    /**
     * Add seen page
     * @return void
     */
    public function logSeenPage(): void
    {
        $this->add('seen', 'Seen page');
    }

    /**
     * Add seen page
     * @param null $formName
     * @return void
     */
    public function logSentForm($formName = null): void
    {
        $this->add('sent form', 'Sent form ' . $formName);
    }

    /**
     * Add information about added record
     * @param null $entityType
     * @return void
     */
    public function logAddedRecord($entityType = null): void
    {
        $this->add('added', 'Added record: ' . $entityType);
    }

    /**
     * Add information about deleted record
     * @param null $entityType
     * @return void
     */
    public function logDeletedRecord($entityType = null): void
    {
        $this->add('deleted', 'Deleted record: ' . $entityType);
    }

    /**
     * Add information about edited record
     * @param null $entityType
     * @return void
     */
    public function logEditedRecord($entityType = null): void
    {
        $this->add('edited', 'Edited record: ' . $entityType);
    }

    /**
     * Log authentication
     * @return void
     */
    public function logAuthentication(): void
    {
        $this->add('authenticated', 'Authenticated user');
    }

    /**
     * Log authentication
     * @return void
     */
    public function logLogout(): void
    {
        $this->add('logged out', 'Logged out user');
    }

    /**
     * Add record
     * @param string $type
     * @param string $description
     * @return void
     */
    private function add(string $type, string $description): void
    {
        $this->userActivityRepository->add(Request::path(), $type, $description, Auth::id());
    }
}
