<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Traits\Response;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class LogoutController extends Controller
{
    use Response;
    public function __invoke()
    {
        $admin = auth('adminapi')->user();
        if ($admin) {
            $admin = Admin::find($admin->id);
            $admin->tokens()->delete();
            return $this->okResponse('Logged Out',[]);
        }
    }
}
