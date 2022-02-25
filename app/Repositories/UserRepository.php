<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    use BaseRepository;

    public function __construct(protected User $model)
    {}

}
