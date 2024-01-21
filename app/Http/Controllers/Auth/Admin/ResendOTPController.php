<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Models\Admin;
use App\Traits\Response;
use App\Traits\Functions;
use App\Http\Controllers\Controller;
use App\Mail\Auth\Admin\ResendOTPMail;
use App\Http\Requests\Auth\Admin\ResendOTPRequest;

class ResendOTPController extends Controller
{
    use Response,Functions;
    public function __invoke(ResendOTPRequest $request)
    {
        $data = $request->validated();
        $admin = Admin::where('email',$data['email'])->first();
        $this->sendMail($admin,new ResendOTPMail($admin));
        return $this->okResponse('Resend OTP successfully');
    }
}
