<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\User\UserResource;
use App\Traits\Response;

class ProfileController extends Controller
{
    use Response;
    public function __invoke()
    {
        $user = auth('userapi')->user();
        return $this->read(UserResource::make($user));
    }
}
