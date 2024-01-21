<?php

namespace App\Http\Requests\Auth\User;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'=>['required','string','email',Rule::exists('users','email')],
            'otp'=>['required','max:5'],
            'password'=>['required','confirmed',Rules\Password::defaults()],
        ];
    }
    public function authorize(): bool
    {
        return true;
    }
}
