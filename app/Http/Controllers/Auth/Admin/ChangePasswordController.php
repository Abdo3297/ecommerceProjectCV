<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Models\Admin;
use App\Traits\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\Admin\ChangePasswordRequest;

class ChangePasswordController extends Controller
{
    use Response;
    public function __invoke(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        $admin = auth('adminapi')->user();
        // $admin = new Admin();
        if (!Hash::check($data['current_password'], $admin->password)) {
            return $this->errorResponse('Password Not Valid');
        }
        $admin->update([
            'password' => Hash::make($data['new_password']),
        ]);
        return $this->okResponse('Password Changed Successfully',[]);
    }
}
