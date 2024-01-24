<?php

namespace App\Http\Controllers\Auth\User;

use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\UpdateProfileRequest;
use App\Http\Resources\Auth\User\UserResource;

class UpdateProfileController extends Controller
{
    use Response;
    public function __invoke(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $data['birth'] = Carbon::createFromFormat('d-m-Y', $data['birth']);
        $user = auth('userapi')->user();
        $user->update($data);
        return $this->okResponse('profile updated',UserResource::make($user));
    }
}