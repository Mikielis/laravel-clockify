<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Throwable;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleSocialiteController extends Controller
{
    /**
     * Redirect to Google
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Get response from Google
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $dbUser = User::where('social_id', $user->id)->first();

            if ($dbUser) {
                Auth::login($dbUser);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id'=> $user->id,
                    'social_type'=> 'google',
                    'password' => encrypt(rand(0,9999) . date('Y-m-d H:i:s'))
                ]);

                Auth::login($newUser);
            }

            return redirect()->route('home');

        } catch (Throwable $e) {
            report($e);
            return redirect()->route('google-incorrect-auth');
        }
    }

    public function incorrectAuth()
    {
        return view('auth.google.incorrect-auth');
    }
}
