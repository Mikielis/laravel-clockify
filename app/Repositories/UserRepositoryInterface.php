<?php

namespace App\Repositories;
use App\Models\User;

interface UserRepositoryInterface
{
    public function getGoogleUser(string $email): User|NULL;

    public function addGoogleUser(string $name, string $email, string $socialId): void;
}
