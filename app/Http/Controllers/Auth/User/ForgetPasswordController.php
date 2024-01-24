<?php

namespace App\Http\Controllers\Auth\User;

use App\Mail\Auth\User\ForgetPasswordMail;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\ForgetPasswordRequest;
use App\Traits\Functions;
use App\Traits\Response;

class ForgetPasswordController extends Controller
{
    use Response,Functions;
    public function __invoke(ForgetPasswordRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        $this->sendMail($user,new ForgetPasswordMail($user));
        return $this->okResponse('OTP Sent successfully',[]);
    }
}
