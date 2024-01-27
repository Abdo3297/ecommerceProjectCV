<?php

namespace App\Http\Resources\Auth\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            // 'birth' => $this->formatBirthDate($this->birth),
            'birth' => $this->birth,
            'roles' => $this->roles->pluck('name') ?? [],
            'roles.permissions' => $this->getPermissionsViaRoles()->pluck(['name']) ?? [],
        ];
    }
    /*protected function formatBirthDate($birth)
    {
        if ($birth instanceof \Carbon\Carbon) {
            return $birth->format('d-m-Y');
        }
        return \Carbon\Carbon::createFromFormat('Y-m-d', $birth)->format('d-m-Y');
    }*/
}
