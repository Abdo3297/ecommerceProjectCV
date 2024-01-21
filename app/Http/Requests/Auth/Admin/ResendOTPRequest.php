<?php

namespace App\Http\Requests\Auth\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ResendOTPRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'=>['required','string','email',Rule::exists('admins','email')]
        ];
    }
    public function authorize(): bool
    {
        return true;
    }
}
