<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Traits\Response;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\Admin\AdminResource;
use App\Http\Requests\Auth\Admin\UpdateProfileRequest;

class UpdateProfileController extends Controller
{
    use Response;
    public function __invoke(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $data['birth'] = Carbon::createFromFormat('d-m-Y', $data['birth']);
        $admin = auth('adminapi')->user();
        $admin->update($data);
        return $this->update(AdminResource::make($admin));
    }
}
