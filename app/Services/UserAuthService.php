<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use Auth;
use Throwable;

class UserAuthService
{
    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(protected UserRepositoryInterface $userRepository)
    {}

    /**
     * @param object $user
     * @return bool
     */
    public function authenticate(object $user): bool
    {
        try {
            $dbUser = $this->userRepository->getGoogleUser($user->email);

            if ($dbUser) {
                Auth::login($dbUser);
            } else {
                $newUser = $this->userRepository->addGoogleUser($user->name, $user->email, $user->id);
                Auth::login($newUser);
            }

            return true;

        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    /**
     * @return void
     */
    static public function logout(): void
    {
        Auth::logout();
    }
}
