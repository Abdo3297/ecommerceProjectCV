<?php

namespace App\Http\Controllers\Auth\User;

use App\Models\User;
use App\Traits\Functions;
use App\Traits\Response;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Mail\Auth\User\UserSignupMail;
use App\Http\Requests\Auth\User\SignupRequest;
use App\Http\Resources\Auth\User\UserResource;

class SignupController extends Controller
{
    use Functions,Response;
    public function __invoke(SignupRequest $request)
    {
        $data = $request->validated();

        $data['birth'] = Carbon::createFromFormat('d-m-Y', $data['birth']);

        $user = User::create($data);

        $token = $user->createToken("token")->plainTextToken;

        //$this->sendMail($user, new UserSignupMail($user));

        return $this->registerOrLogin('Created User , Verify Your Email',UserResource::make($user),$token,201);
    }
}
