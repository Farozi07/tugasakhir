<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GitHubController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::firstOrCreate(
            ['email' => $githubUser->getEmail()],
            [
                'name' => $githubUser->getName(),
                'github_id' => $githubUser->getId(),
                'email_verified_at' => now(),
                'role_id' => 2,
            ]
        );

        Auth::login($user, true);

        return redirect()->intended('guest/dashboard');
    }
}
