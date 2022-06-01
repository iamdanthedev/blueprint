<?php

namespace App\Http\Controllers;

use App\Auth\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function redirect() {
        return Socialite::driver('github')->redirect();
    }

    public function callback() {
        $socialiteUser = Socialite::driver('github')->user();
        $user = $this->userService->handleGithubUser($socialiteUser);
        Auth::login($user);

        return Response::redirectTo('/');
    }
}
