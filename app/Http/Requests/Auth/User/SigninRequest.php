<?php

namespace App\Http\Requests\Auth\User;

use Illuminate\Foundation\Http\FormRequest;

class SigninRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required','string','email'],
            'password' => ['required','string'],
        ];
    }
    public function authorize(): bool
    {
        return true;
    }
}
