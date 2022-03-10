<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface
{
    use BaseRepository;

    /**
     * @param User $model
     */
    public function __construct(
        protected User $model
    ) {}

    /**
     * @param string $email
     * @return Model|null
     */
    public function getGoogleUser(string $email): User|NULL
    {
        return User::where([
            ['email', '=', $email],
            ['social_type', '=', 'google']
        ])->first();
    }

    /**
     * Add new user account getting data from Google
     *
     * @param string $name
     * @param string $email
     * @param string $socialId
     * @return void
     */
    public function addGoogleUser(string $name, string $email, string $socialId): void
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'social_id'=> $socialId,
            'social_type'=> 'google',
            'password' => Hash::make(Str::random(10))
        ]);
    }
}
