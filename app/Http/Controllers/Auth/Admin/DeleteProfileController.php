<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Models\Admin;
use App\Traits\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\Admin\DeleteProfileRequest;

class DeleteProfileController extends Controller
{
    use Response;
    public function __invoke(DeleteProfileRequest $request)
    {
        $data = $request->validated();
        $admin = auth('adminapi')->user();
        // $admin = new Admin();
        if (!Hash::check($data['password'], $admin->password)) {
            return $this->errorResponse('Invalid password');
        }
        $admin->tokens()->delete();
        $admin->delete();
        return $this->okResponse('Account deleted successfully',[]);
    }
}
