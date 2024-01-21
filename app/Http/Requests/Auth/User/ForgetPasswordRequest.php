<?php

namespace App\Http\Requests\Auth\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'=>['required','string','email',Rule::exists('users','email')]
        ];
    }
    public function authorize(): bool
    {
        return true;
    }
}
