<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Models\Admin;
use Ichtrojan\Otp\Otp;
use App\Traits\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\Admin\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    use Response;
    public function __invoke(ResetPasswordRequest $request)
    {
        $data = $request->validated();
        $admin = Admin::where('email', $data['email'])->first();
        $otp2 = (new Otp)->validate($admin->email, $data['otp']);
        if (!$otp2->status) {
            return $this->errorResponse('OTP Not Valid');
        }
        $admin->update([
            'password' => Hash::make($data['password'])
        ]);
        $admin->tokens()->delete();
        return $this->okResponse('Password Reset Successfully');
    }
}
