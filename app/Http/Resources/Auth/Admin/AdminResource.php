<?php

namespace App\Http\Resources\Auth\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'birth' => $this->formatBirthDate($this->birth),
        ];
    }
    protected function formatBirthDate($birth)
    {
        if ($birth instanceof \Carbon\Carbon) {
            return $birth->format('d-m-Y');
        }
        return \Carbon\Carbon::createFromFormat('Y-m-d', $birth)->format('d-m-Y');
    }
}
