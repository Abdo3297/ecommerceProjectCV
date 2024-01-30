<?php

namespace App\Http\Controllers\Auth\User;

use App\Models\User;
use App\Traits\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\User\DeleteProfileRequest;

class DeleteProfileController extends Controller
{
    use Response;
    public function __invoke(DeleteProfileRequest $request)
    {
        $data = $request->validated();
        $user = auth('userapi')->user();
        $user = new User();
        if (!Hash::check($data['password'], $user->password)) {
            return $this->errorResponse('Invalid password');
        }
        $user->tokens()->delete();
        $user->delete();
        return $this->okResponse('Account deleted successfully',[]);
    }
}
