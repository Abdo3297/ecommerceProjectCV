<?php

namespace App\Http\Resources\Auth\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $defaultImage = asset('Default/profile.jpeg');
        return [
            'admin_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'image' => $this->getFirstMediaUrl('admin_profile_image')?:$defaultImage,
            'birth' => $this->birth,
            'roles' => $this->roles->pluck('name') ?? [],
            'roles.permissions' => $this->getPermissionsViaRoles()->pluck(['name']) ?? [],
        ];
    }
}
