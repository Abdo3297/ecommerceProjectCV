<?php

namespace App\Http\Controllers\Auth\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
        // return Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
    }
    public function handleGoogleCallback()
    {

        $socialiteUser = Socialite::driver('google')->stateless()->user();
        $user = User::updateOrCreate([
            'provider' => 'google',
            'provider_id' => $socialiteUser->getId(),
        ], [
            'name' => $socialiteUser->getName(),
            'email' => $socialiteUser->getEmail(),
        ]);

        Auth::login($user);

        return response()->json([
            'message'=>'successfully login with google',
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
