<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Models\Admin;
use App\Traits\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\Admin\SigninRequest;
use App\Http\Resources\Auth\Admin\AdminResource;

class SigninController extends Controller
{
    use Response;
    public function __invoke(SigninRequest $request)
    {
        $data = $request->validated();
        $admin = Admin::where('email', $data['email'])->first();
        if ($admin && Hash::check($data['password'], $admin->password)) {
            $admin->tokens()->delete();
            $token = $admin->createToken('token')->plainTextToken;
            return $this->signin(AdminResource::make($admin), $token);
        }
        return $this->errorResponse('Invalid email or password');
    }
}
