<?php

namespace App\Http\Controllers\Auth\User;

use App\Models\User;
use App\Traits\Response;
use App\Traits\Functions;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
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
        $user = User::create($data);
        // assign role to user
        $user_role = Role::where('name','user')->first();
        if($user_role){
            $user->assignRole($user_role);
        }
        $token = $user->createToken("token")->plainTextToken;
        //$this->sendMail($user, new UserSignupMail($user));
        return $this->registerOrLogin('Created User',UserResource::make($user),$token,201);
    }
}
