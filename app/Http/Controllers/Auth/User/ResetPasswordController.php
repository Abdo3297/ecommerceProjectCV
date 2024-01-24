<?php

namespace App\Http\Controllers\Auth\User;

use App\Models\User;
use Ichtrojan\Otp\Otp;
use App\Traits\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\User\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    use Response;
    public function __invoke(ResetPasswordRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        $otp2 = (new Otp)->validate($user->email, $data['otp']);
        if (!$otp2->status) {
            return $this->errorResponse('OTP Not Valid');
        }
        $user->update([
            'password' => Hash::make($data['password'])
        ]);
        $user->tokens()->delete();
        return $this->okResponse('Password Reset Successfully',[]);
    }
}
