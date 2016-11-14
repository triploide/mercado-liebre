<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $userGithub = Socialite::driver('github')->user();
        $user = User::where('github_id', $userGithub->id)->first();
        if (!$user) {
          $user = User::create();
        }
        \Auth::login($user);
        return redirect('home');

        // $user->token;
    }
}
