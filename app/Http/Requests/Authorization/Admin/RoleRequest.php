<?php

namespace App\Http\Requests\Authorization\Admin;

use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => ['required','string','unique:'.Role::class],
            'guard_name' => ['required','string',Rule::in('userapi')],
        ];
    }
}
