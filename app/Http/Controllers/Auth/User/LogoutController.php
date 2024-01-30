<?php

namespace App\Http\Controllers\Auth\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Traits\Response;

class LogoutController extends Controller
{
    use Response;
    public function __invoke()
    {
        $user = auth('userapi')->user();
        if ($user) {
            $user = new User();
            $user->tokens()->delete();
            return $this->okResponse('Logged Out',[]);
        }
    }
}
