<?php

namespace App\Http\Requests\Authorization\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RolePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'role_id' => ['required','integer',Rule::exists('roles','id')],
            'permissions' => ['required','array'],
            'permissions.*' => ['string',Rule::exists('permissions','name')],
        ];
    }
}
