<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryInterface;
use Auth;
use Throwable;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;

class GoogleSocialiteController extends Controller
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {}

    /**
     * Redirect to Google
     * @return RedirectResponse|SymfonyRedirectResponse
     */
    public function redirect(): SymfonyRedirectResponse|RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Get response from Google
     * @return RedirectResponse
     */
    public function handleCallback(): RedirectResponse
    {
        try {
            $user = Socialite::driver('google')->user();
            $dbUser = $this->userRepository->getGoogleUser($user->email);

            if ($dbUser) {
                Auth::login($dbUser);
            } else {
                $newUser = $this->userRepository->addGoogleUser($user->name, $user->email, $user->id);
                Auth::login($newUser);
            }

            return redirect()->route('home');

        } catch (Throwable $e) {
            report($e);
            return redirect()->route('google-incorrect-auth');
        }
    }

    public function incorrectAuth(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.google.incorrect-auth');
    }
}
