<?php

namespace App\Http\Controllers\Auth\User;

use App\Traits\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\User\ChangePasswordRequest;

class ChangePasswordController extends Controller
{
    use Response;
    public function __invoke(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        $user = auth('userapi')->user();
        if (!Hash::check($data['current_password'], $user->password)) {
            return $this->errorResponse('Password Not Valid');
        }
        $user->update([
            'password' => Hash::make($data['new_password']),
        ]);
        return $this->okResponse('Password Changed Successfully');
    }
}
