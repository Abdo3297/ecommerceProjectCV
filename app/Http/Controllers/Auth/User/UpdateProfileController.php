<?php

namespace App\Http\Controllers\Auth\User;

use App\Traits\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\UpdateProfileRequest;
use App\Http\Resources\Auth\User\UserResource;
use App\Models\User;

class UpdateProfileController extends Controller
{
    use Response;
    public function __invoke(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $user = auth('userapi')->user();
        // $user = new User();
        $user->update($data);
        if ($request->hasFile('image')) {
            $user->addMediaFromRequest('image')->toMediaCollection('user_profile_image');
        }
        return $this->okResponse('profile updated',UserResource::make($user));
    }
}