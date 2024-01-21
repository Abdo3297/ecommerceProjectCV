<?php

namespace App\Http\Controllers\Auth\User;

use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }
    public function handleFacebookCallback()
    {

        $socialiteUser = Socialite::driver('facebook')->stateless()->user();
        $user = User::updateOrCreate([
            'provider' => 'facebook',
            'provider_id' => $socialiteUser->getId(),
        ], [
            'name' => $socialiteUser->getName(),
            'email' => $socialiteUser->getEmail(),
        ]);

        Auth::login($user);

        return response()->json([
            'message'=>'successfully login with facebook',
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
