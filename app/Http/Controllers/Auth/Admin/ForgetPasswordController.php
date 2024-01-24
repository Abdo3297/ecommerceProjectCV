<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Models\Admin;
use App\Traits\Response;
use App\Traits\Functions;
use App\Http\Controllers\Controller;
use App\Mail\Auth\Admin\ForgetPasswordMail;
use App\Http\Requests\Auth\Admin\ForgetPasswordRequest;

class ForgetPasswordController extends Controller
{
    use Response,Functions;
    public function __invoke(ForgetPasswordRequest $request)
    {
        $data = $request->validated();
        $admin = Admin::where('email', $data['email'])->first();
        $this->sendMail($admin,new ForgetPasswordMail($admin));
        return $this->okResponse('OTP Sent successfully',[]);
    }
}
