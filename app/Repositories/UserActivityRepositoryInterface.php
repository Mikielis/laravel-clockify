<?php

namespace App\Repositories;
use App\Models\UserActivity;

interface UserActivityRepositoryInterface
{

    /**
     * Add new record
     * @param string $page
     * @param string $type
     * @param string $description
     * @param int $userId
     * @return void
     */
    public function add(string $page, string $type, string $description, int $userId): void;
}
