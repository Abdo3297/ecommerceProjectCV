<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Traits\Response;
use Illuminate\Support\Carbon;
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
        /*if ($request->hasFile('image')) {
            $seeker->addMediaFromRequest('image')->toMediaCollection('seeker_profile_image');
        }*/
        if ($request->has('birth')) {
            $data['birth'] = Carbon::createFromFormat('d-m-Y', $data['birth']);
        }
        $admin = auth('adminapi')->user();
        // $admin = Admin::find($admin->id);
        $admin->update($data);
        if ($request->hasFile('image')) {
            $admin->addMediaFromRequest('image')->toMediaCollection('admin_profile_image');
        }
        return $this->okResponse('profile updated', AdminResource::make($admin));
    }
}
