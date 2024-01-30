<?php

namespace App\Http\Resources\Auth\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $defaultImage = asset('Default/profile.jpeg');
        return [
            'user_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'birth' => $this->birth,
            'image' => $this->getFirstMediaUrl('user_profile_image')?:$defaultImage,
            'roles' => $this->roles->pluck('name') ?? [],
            'roles.permissions' => $this->getPermissionsViaRoles()->pluck(['name']) ?? [],
        ];
    }
}
