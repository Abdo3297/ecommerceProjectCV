<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\ResendOtpRequest;
use App\Mail\Auth\User\ResendOTPMail;
use App\Models\User;
use App\Traits\Functions;
use App\Traits\Response;

class ResendOtpController extends Controller
{
    use Response,Functions;
    public function __invoke(ResendOtpRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email',$data['email'])->first();
        $this->sendMail($user,new ResendOTPMail($user));
        return $this->okResponse('Resend OTP successfully');
    }
}
