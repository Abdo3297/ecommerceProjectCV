<?php

namespace App\Http\Requests\Auth\User;

use Illuminate\Foundation\Http\FormRequest;

class DeleteProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => ['required','string'],
        ];
    }
    public function authorize(): bool
    {
        return true;
    }
}
