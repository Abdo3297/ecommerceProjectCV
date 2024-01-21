<?php

namespace App\Http\Controllers\Auth\User;

use App\Models\User;
use App\Traits\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\User\SigninRequest;
use App\Http\Resources\Auth\User\UserResource;

class SigninController extends Controller
{
    use Response;
    public function __invoke(SigninRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        if ($user && Hash::check($data['password'], $user->password)) {
            $token = $user->createToken("token")->plainTextToken;
            return $this->registerOrLogin('Logged User', UserResource::make($user), $token, 200);
        }
        return $this->errorResponse('Invalid email or password');
    }
}
