<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserAuthService;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;

class GoogleSocialiteController extends Controller
{
    public function __construct(protected UserAuthService $userAuthService)
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
        $user = Socialite::driver('google')->user();
        $isAuthenticated = $this->userAuthService->authenticate($user);

        if (!$isAuthenticated) {
            return redirect()->route('google-incorrect-auth');
        }

        return redirect()->route('home');
    }

    public function incorrectAuth(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.google.incorrect-auth');
    }
}
