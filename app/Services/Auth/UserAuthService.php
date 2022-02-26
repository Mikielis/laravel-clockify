<?php

namespace App\Services\Auth;

use App\Repositories\UserRepositoryInterface;
use App\Services\Auth\UserAuthAllowedDomains;
use Auth;
use function report;
use Throwable;

class UserAuthService
{
    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected UserAuthAllowedDomains $allowedDomains
    ) {}

    /**
     * @param object $user
     * @return bool
     */
    public function authenticate(object $user): bool
    {
        // Check if user account with provided domain can be authenticated
        $whitelistedEmails = explode('@', $user->email);
        $emailDomain = array_pop($whitelistedEmails);

        if (!$this->allowedDomains->check($emailDomain)) {
            return false;
        }

        // Try to log in user
        try {
            $dbUser = $this->userRepository->getGoogleUser($user->email);

            if ($dbUser) {
                Auth::login($dbUser);
            } else {
                $newUser = $this->userRepository->addGoogleUser($user->name, $user->email, $user->id);
                Auth::login($newUser);
            }

            return true;

        // Report error if something goes wrong
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
