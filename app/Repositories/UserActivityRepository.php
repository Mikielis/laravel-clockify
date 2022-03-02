<?php

namespace App\Repositories;

use App\Models\UserActivity;


class UserActivityRepository implements UserActivityRepositoryInterface
{
    use BaseRepository;

    /**
     * Allowed activity types
     * @var array|string[]
     */
    protected array $types = [
        'seen' => 'Seen',
        'sent form' => 'Sent form',
        'deleted' => 'Deleted',
        'edited' => 'Edited',
        'authenticated' => 'Authenticated',
        'logged out' => 'Logged out'
    ];

    /**
     * Add new record
     * @param string $page
     * @param string $type
     * @param string $description
     * @param int $userId
     * @return bool
     */
    public function add(string $page, string $type, string $description, int $userId): void
    {
        UserActivity::create([
            'type' => $this->types[$type],
            'page' => $page,
            'activity_description' => $description,
            'user_id' => $userId
        ]);
    }
}
