<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Traits\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\Admin\AdminResource;
use App\Http\Requests\Auth\Admin\UpdateProfileRequest;
use App\Models\Admin;

class UpdateProfileController extends Controller
{
    use Response;
    public function __invoke(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $admin = auth('adminapi')->user();
        $admin = new Admin();
        $admin->update($data);
        if ($request->hasFile('image')) {
            $admin->addMediaFromRequest('image')->toMediaCollection('admin_profile_image');
        }
        return $this->okResponse('profile updated', AdminResource::make($admin));
    }
}
