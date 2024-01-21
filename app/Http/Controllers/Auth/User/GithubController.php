<?php

namespace App\Http\Controllers\Auth\User;

use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function redirectToGithub()
    {
        return Socialite::driver('github')->stateless()->redirect();
    }
    public function handleGithubCallback()
    {

        $socialiteUser = Socialite::driver('github')->stateless()->user();
        $user = User::updateOrCreate([
            'provider' => 'github',
            'provider_id' => $socialiteUser->getId(),
        ], [
            'name' => $socialiteUser->getName(),
            'email' => $socialiteUser->getEmail(),
        ]);

        Auth::login($user);

        return response()->json([
            'message'=>'successfully login with github',
            'data' => [
                'id'=>$user->id,
                'token'=>$socialiteUser->token,
                'name' => $socialiteUser->getName(),
                'email' => $socialiteUser->getEmail(),
                'image'=>$socialiteUser->getAvatar(),
            ],
            'status'=>true,
            'code'=>Response::HTTP_OK
        ],Response::HTTP_OK);
    }
}
