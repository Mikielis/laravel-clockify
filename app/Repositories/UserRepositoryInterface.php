<?php

namespace App\Repositories;
use App\Models\User;

interface UserRepositoryInterface
{
    public function getGoogleUser(string $socialId): User|NULL;

    public function addGoogleUser(string $name, string $email, string $socialId): User|NULL;
}
