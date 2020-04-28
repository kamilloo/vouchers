<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Domain\Merchants\SocialFacebookAccountService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

class LoginFacebookController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(SocialFacebookAccountService $service)
    {
        $user = Socialite::driver('facebook')->user();
        $user = $service->createOrGetUser($user);

        auth()->login($user);
        return redirect()->route('home');
    }
}
